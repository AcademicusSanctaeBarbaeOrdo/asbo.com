<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\WhosWhoBundle\Controller;

use Asbo\Bundle\WhosWhoBundle\Model\FraResourceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController as BaseResourceController;

/**
 * Base controller for whoswho system controllers.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
abstract class Controller extends BaseResourceController
{
    /**
     * {@inheritdoc}
     */
    public function indexAction(Request $request)
    {
        if (!$this->getFraAclManager()->canList()) {
            throw new AccessDeniedException(
                sprintf('You cannot show a list of %s', $this->getConfiguration()->getPluralResourceName())
            );
        }

        return parent::indexAction($request);
    }

    /**
     * {@inheritdoc}
     */
    public function updateAction(Request $request)
    {
        $config = $this->getConfiguration();

        $resource = $this->findOr404();
        $fra = $resource;

        if ($resource instanceof FraResourceInterface) {
            $fra = $resource->getFra();
        }

        if (!$this->getFraAclManager()->canEdit($fra)) {
            throw new AccessDeniedException(
                sprintf('You cannot update %s "#%d"', $this->getConfiguration()->getResourceName(), $resource->getId())
            );
        }

        $form = $this->getForm($resource);

        if (($request->isMethod('PUT') || $request->isMethod('POST')) && $form->bind($request)->isValid()) {
            $event = $this->update($resource);
            if (!$event->isStopped()) {
                $this->setFlash('success', 'update');

                return $this->redirectTo($resource);
            }

            $this->setFlash($event->getMessageType(), $event->getMessage(), $event->getMessageParams());
        }

        if ($config->isApiRequest()) {
            return $this->handleView($this->view($form));
        }

        $view = $this
            ->view()
            ->setTemplate($config->getTemplate('update.html'))
            ->setData(
                [
                    $config->getResourceName() => $resource,
                    'form' => $form->createView()
                ]
            )
        ;

        return $this->handleView($view);
    }

    /**
     * @return \Asbo\Bundle\WhosWhoBundle\Security\Acl\RoleFraAcl
     */
    protected function getFraAclManager()
    {
        return $this->get('asbo_whoswho.security.acl.role_fra_acl');
    }
}
