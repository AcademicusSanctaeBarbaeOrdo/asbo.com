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
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Resource Controller.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 *
 * @method \Asbo\Bundle\WhosWhoBundle\Model\FraResourceInterface findOr404
 */
class ResourceController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function createNew()
    {
        if (null === $fraSlug = $this->getRequest()->get('slug')) {
            throw new NotFoundHttpException('No parent resource given.');
        }

        $fra = $this->findFraOr404($fraSlug);

        if (!$this->getFraAclManager()->canEdit($fra)) {
            throw new AccessDeniedException(
                sprintf('You cannot create %s! to fra "%d"', $this->getConfiguration>getResourceName(), $fra->getId())
            );
        }

        $resource = parent::createNew();
        $resource->setFra($fra);

        return $resource;
    }

    /**
     * We overide the parent fonction to add one step to delete the resource.
     *
     * {@inheritdoc}
     */
    public function deleteAction(Request $request)
    {
        $resource = $this->findOr404();

        if (!$this->getFraAclManager()->canEdit($resource->getFra())) {
            throw new AccessDeniedException(
                sprintf('You cannot delete %s "#%d"!', $this->getConfiguration()->getResourceName(), $resource->getId())
            );
        }

        $form = $this->createDeleteForm($resource);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $event = $this->delete($resource);

            if ($event->isStopped()) {
                $this->setFlash($event->getMessageType(), $event->getMessage(), $event->getMessageParams());

                return $this->redirectTo($resource);
            }

            $this->setFlash('success', 'delete');

            $config = $this->getConfiguration();

            return $this->redirectToRoute(
                $config->getRedirectRoute('index'),
                $config->getRedirectParameters()
            );
        }

        $view = $this
            ->view()
            ->setTemplate($this->getConfiguration()->getTemplate('delete.html'))
            ->setData(
                [
                    $this->getConfiguration()->getResourceName() => $resource,
                    'form' => $form->createView()
                ]
            )
        ;

        return $this->handleView($view);
    }

    /**
     * Get fra or 404.
     *
     * @param string $slug
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @return \Asbo\Bundle\WhosWhoBundle\Entity\Fra
     */
    protected function findFraOr404($slug)
    {
        if (!$fra = $this->getFraRepository()->findOneBy(['slug' => $slug])) {
            throw new NotFoundHttpException('Requested fra does not exist.');
        }

        return $fra;
    }

    /**
     * Creates a form to delete a resource entity by id.
     *
     * @param FraResourceInterface $resource
     *
     * @return \Symfony\Component\Form\Form The form
     */
    protected function createDeleteForm(FraResourceInterface $resource)
    {
        $routeParam = [
            'id' => $resource->getId(),
            'slug' => $resource->getFra()->getSlug()
        ];

        return $this
            ->createFormBuilder()
            ->setAction($this->generateUrl($this->getConfiguration()->getRouteName('delete'), $routeParam))
            ->setMethod('DELETE')
            ->add('submit', 'submit', ['label' => 'Delete'])
            ->getForm()
        ;
    }

    /**
     * Get fra repository.
     *
     * @return \Asbo\Bundle\WhosWhoBundle\Doctrine\FraRepository
     */
    protected function getFraRepository()
    {
        return $this->get('asbo_whoswho.repository.fra');
    }
}
