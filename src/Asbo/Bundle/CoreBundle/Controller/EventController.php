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

use Asbo\Bundle\CoreBundle\Entity\EventHasFra;
use Asbo\Bundle\EventBundle\Controller\EventController as BaseEventController;
use RuntimeException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Controller of event page
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class EventController extends BaseEventController
{
    public function subscribeAction(Request $request, $token, $status)
    {
        if (null === $this->getUser()) {
            throw new AccessDeniedException('You aren\'t connected.');
        }

        /** @var \Asbo\Bundle\CoreBundle\Entity\Event $event */
        $event = $this->findOr404();

        $csrfProvider = $this->getCsrfProvider();
        $expectedToken = sprintf('event_%s', $event->getId());

        if (!$csrfProvider->isCsrfTokenValid($expectedToken, $token)) {
            throw new RuntimeException('CSRF attack detected.');
        }

        $fra = $this->findFraOr404();

        if (!$this->getFraAclManager()->canEdit($fra)) {
            throw new AccessDeniedException(
                sprintf('You cannot edit fra "#%d"!', $fra->getId())
            );
        }

        /** @var \Asbo\Bundle\CoreBundle\Entity\EventHasFra $eventHasFra */
        $repository = $this->getEventHasFraRepository();
        $exists = $repository->findOneBy(['event' => $event, 'fra' => $fra]);

        if (null !== $exists && $exists instanceof EventHasFra) {

            if ($status === $exists->getStatus()) {
                $this->setFlash('info', 'subscribe_yet');

                return $this->redirectTo($event);
            }

            $exists->setStatus($status);
            $this->setFlash('info', 'subscribe_change');

            $this->get('asbo.manager.event_has_fra')->persist($exists);
            $this->get('asbo.manager.event_has_fra')->flush();

            return $this->redirectTo($event);
        }

        $eventHasFra = $repository->createNew();
        $eventHasFra->setFra($fra);
        $eventHasFra->setStatus($status);

        $event->addEventHasFra($eventHasFra);
        $this->create($event);

        return $this->redirectTo($event);
    }

    /**
     * Get the CSRF provider.
     *
     * @return \Symfony\Component\Form\Extension\Csrf\CsrfProvider\SessionCsrfProvider
     */
    protected function getCsrfProvider()
    {
        return $this->get('form.csrf_provider');
    }

    /**
     * @return mixed
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    protected function findFraOr404()
    {
        $fraHasUser = $this->getFraHasUserRepository()->findOneBy(['user' => $this->getUser(), 'owner' => true]);

        if (null === $fraHasUser) {
            throw $this->createNotFoundException('You haven\'t a fra associated to your account.');
        }

        return $fraHasUser->getFra();
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
}
