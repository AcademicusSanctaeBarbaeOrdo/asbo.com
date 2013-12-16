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

use Asbo\Bundle\WhosWhoBundle\Form\Filter\FraFilterType;
use Asbo\Bundle\WhosWhoBundle\Form\Type\SettingsType;
use RuntimeException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Controller of fra page.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 *
 * @method \Asbo\Bundle\WhosWhoBundle\Doctrine\FraRepository getRepository()
 */
class FraController extends Controller
{
    /**
     * {@inhertiDocs}
     */
    public function showAction()
    {
        $fra = $this->findOr404();

        if (!$this->getFraAclManager()->canView($fra)) {
            throw new AccessDeniedException(
                sprintf('You cannot edit fra "#%d"!', $fra->getId())
            );
        }

        $config = $this->getConfiguration();

        $view = $this
            ->view()
            ->setTemplate($config->getTemplate('show.html'))
            ->setTemplateVar($config->getResourceName())
            ->setData($fra)
        ;

        return $this->handleView($view);
    }

    /**
     * Search in fras.
     */
    public function searchAction(Request $request)
    {
        /** @var \Symfony\Component\Form\Form $form */
        $form = $this->get('form.factory')->create(new FraFilterType());
        $fras = [];
        $search = false;

        if ($request->query->has('submit-filter')) {

            $form->submit($request);

            $filterBuilder = $this->getRepository()->createQueryBuilder('e');

            $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $filterBuilder);

            $fras = $filterBuilder->getQuery()->getResult();
            $search = true;
        }

        return $this->renderResponse(
            'search.html',
            [
                'form' => $form->createView(),
                'fras' => $fras,
                'search' => $search
            ]
        );

    }

    /**
     * Settings
     */
    public function settingsAction(Request $request)
    {
        $fra  = $this->findOr404();
        $form = $this->get('form.factory')->create(new SettingsType(), $fra->getSettings());

        /** @var \Symfony\Component\Form\FormInterface $form */
        $form->handleRequest($request);

        if ($form->isValid()) {

            $fra->setSettings($form->getData());
            $this->update($fra);
            $this->setFlash('success', 'update_settings');

            return $this->redirectTo($fra);
        }

        $view = $this
            ->view()
            ->setTemplate($this->getConfiguration()->getTemplate('settings.html'))
            ->setData(
                [
                    $this->getConfiguration()->getResourceName() => $fra,
                    'form' => $form->createView()
                ]
            )
        ;

        return $this->handleView($view);
    }

    /**
     * Returns the people who will have their birthday in an interval of days.
     */
    public function getNextBirthdayInAnIntervalOfAction($interval = 7)
    {
        $fras = $this
            ->getRepository()
            ->findNextBirthdayInAnIntervalOf($interval)
        ;

        return $this->renderResponse(
            'birthdayBeetween.html',
            [
                'fras'  => $fras
            ]
        );
    }

    /**
     * Returns the last connecting fras.
     */
    public function getLastLoginAction($nb = 10)
    {
        $fras = $this
            ->getRepository()
            ->findLastLogin($nb)
        ;

        return $this->renderResponse(
            'lastConnection.html',
            [
                'fras' => $fras
            ]
        );
    }

    /**
     * Set default sub resource to fra.
     */
    public function setDefaultSubResourceAction($namespace, $id, $token)
    {
        $fra = $this->findOr404();
        $controller = $this->getSubResourceController($namespace);

        /** @var \Asbo\Bundle\WhosWhoBundle\Model\FraResourceInterface $resource */
        $resource = $controller->findOr404(['fra' => $fra, 'id' => $id]);

        $csrfProvider = $this->getCsrfProvider();
        $expectedToken = sprintf('%s_%s', $namespace, $resource->getId());

        if (!$csrfProvider->isCsrfTokenValid($expectedToken, $token)) {
            throw new RuntimeException('CSRF attack detected.');
        }

        if (!$this->getFraAclManager()->canEdit($fra)) {
            throw new AccessDeniedException(
                sprintf('You cannot update %s "#%d"!', $controller->getConfiguration()->getResourceName(), $fra->getId())
            );
        }

        $method = ucfirst($namespace);
        $getMethod = sprintf('getPrincipal%s', $method);
        $setMethod = sprintf('setPrincipal%s', $method);

        if ($fra->{$getMethod}() == $resource) {
            $this->setFlash('warning', sprintf('same_%s', $namespace));

            return $this->redirectTo($fra);
        }

        $fra->{$setMethod}($resource);

        $this->dispatchEvent(sprintf('pre_update_principal_%s', $namespace), $fra);
        $this->persistAndFlush($fra, sprintf('update_principal_%s', $namespace));
        $this->setFlash('success', sprintf('set_principal_%s', $namespace));

        return $this->redirectTo($fra);
    }

    /**
     * Get the controller of a sub resource of fra.
     *
     * @param  string                                           $resource
     * @return \Asbo\Bundle\WhosWhoBundle\Controller\Controller
     */
    protected function getSubResourceController($resource)
    {
        return $this->get(sprintf('asbo_whoswho.controller.%s', $resource));
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
}
