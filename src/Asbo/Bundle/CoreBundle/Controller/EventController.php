<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\CoreBundle\Controller;

use Asbo\Bundle\CoreBundle\Entity\Event;
use Asbo\Bundle\CoreBundle\Entity\EventHasFra;
use Asbo\Bundle\EventBundle\Controller\EventController as BaseEventController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Controller of event page.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 *
 * @method \Asbo\Bundle\CoreBundle\Entity\Event findOr404()
 */
class EventController extends BaseEventController
{
    /**
     * Register for an event.
     */
    public function registerAction($token, $status)
    {
        $event = $this->findOr404();
        $fra = $this->findFraOr404();

        if (!$this->isCsrfValid($event, $token)) {
            throw new \RuntimeException('The given token is invalid. (CSRF attack !?)');
        }

        if (!$this->getFraAclManager()->canEdit($fra)) {
            throw new AccessDeniedException(
                sprintf('You cannot edit fra "#%d"!', $fra->getId())
            );
        }

        $repository = $this->getEventHasFraRepository();
        $exists = $repository->findOneBy(['event' => $event, 'fra' => $fra]);

        if ($exists instanceof EventHasFra) {

            $this->update($exists->setStatus($status));

            $this->setFlash('info', sprintf('register_status_%s', $status));

            return $this->redirectTo($event);
        }

        /** @var \Asbo\Bundle\CoreBundle\Entity\EventHasFra $eventHasFra */
        $eventHasFra = $repository->createNew();
        $eventHasFra->setFra($fra)->setStatus($status);

        $event->addEventHasFra($eventHasFra);
        $this->create($event);

        return $this->redirectTo($event);
    }

    /**
     * Find current fra.
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @return \Asbo\Bundle\WhosWhoBundle\Entity\Fra
     */
    protected function findFraOr404()
    {
        $fraHasUser = $this->getFraHasUserRepository()->findOneBy(['user' => $this->getUserOr403(), 'owner' => true]);

        if (null === $fraHasUser) {
            throw $this->createNotFoundException('You haven\'t a fra associated to your account.');
        }

        return $fraHasUser->getFra();
    }

    /**
     * Returns the user or throw an access denied exception.
     *
     * @throws AccessDeniedException
     * @return UserInterface
     */
    protected function getUserOr403()
    {
        if (null === $this->getUser()) {
            throw new AccessDeniedException('You aren\'t connected.');
        }

        return $this->getUser();
    }

    /**
     * Check if the CSRF token is valid or not.
     *
     * @param Event  $event
     * @param string $token
     *
     * @return boolean
     */
    protected function isCsrfValid(Event $event, $token)
    {
        $expectedToken = sprintf('event_%s', $event->getId());

        return $this->getCsrfProvider()->isCsrfTokenValid($expectedToken, $token);
    }

    /**
     * @return \Asbo\Bundle\WhosWhoBundle\Doctrine\EntityRepository
     */
    protected function getFraHasUserRepository()
    {
        return $this->get('asbo_whoswho.repository.fra_has_user');
    }

    /**
     * @return \Asbo\Bundle\WhosWhoBundle\Doctrine\EntityRepository
     */
    protected function getEventHasFraRepository()
    {
        return $this->get('asbo.repository.event_has_fra');
    }

    /**
     * @return \Asbo\Bundle\WhosWhoBundle\Security\Acl\RoleFraAcl
     */
    protected function getFraAclManager()
    {
        return $this->get('asbo_whoswho.security.acl.role_fra_acl');
    }

    /**
     * @return \Symfony\Component\Form\Extension\Csrf\CsrfProvider\SessionCsrfProvider
     */
    protected function getCsrfProvider()
    {
        return $this->get('form.csrf_provider');
    }
}
