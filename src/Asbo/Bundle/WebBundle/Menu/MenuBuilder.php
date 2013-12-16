<?php

namespace Asbo\Bundle\WebBundle\Menu;

use Asbo\Bundle\WhosWhoBundle\Doctrine\EntityRepository;
use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Asbo\Bundle\WhosWhoBundle\Util\AnnoManipulator;

class MenuBuilder
{
    /**
     * Menu factory.
     *
     * @var FactoryInterface
     */
    protected $factory;

    /**
     * Security context.
     *
     * @var SecurityContextInterface
     */
    protected $securityContext;

    /**
     * Translator instance.
     *
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * @var \Asbo\Bundle\WhosWhoBundle\Doctrine\EntityRepository
     */
    protected $fraHasUserManager;

    protected $asbo;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory, SecurityContextInterface $securityContext, TranslatorInterface $translator, EntityRepository $fraHasUserManager, $asbo)
    {
        $this->factory = $factory;
        $this->securityContext = $securityContext;
        $this->translator = $translator;
        $this->fraHasUserManager = $fraHasUserManager;
        $this->asbo = $asbo;
    }

    public function createMainMenu(Request $request)
    {
        $menu = $this->factory->createItem('root', array(
                'childrenAttributes' => array(
                    'class' => 'navigation'
                )
            ));

        $menu->setCurrentUri($request->getRequestUri());

        $menu->addChild('home',
            [
                'route' => 'homepage',
                'linkAttributes' => array('title' => $this->trans('asbo.frontend.menu.main.homepage')),
                'attributes' => array('class' => 'orange'),
                'labelAttributes' => array('icon' => 'fa fa-home', 'iconOnly' => false)
            ]
        )->setLabel($this->trans('asbo.frontend.menu.main.homepage'));

        $menu->addChild('ordre',
            [
                'route' => 'ordre',
                'linkAttributes' => array('title' => $this->trans('asbo.frontend.menu.main.ordre')),
                'attributes' => array('class' => 'blue'),
                'labelAttributes' => array('icon' => 'fa fa-book', 'iconOnly' => false)
            ]
        )->setLabel($this->trans('asbo.frontend.menu.main.ordre'));

        $menu->addChild('ephemeride',
            [
                'route' => 'asbo_event_upcoming',
                'linkAttributes' => array('title' => $this->trans('asbo.frontend.menu.main.ephemeride')),
                'attributes' => array('class' => 'purple'),
                'labelAttributes' => array('icon' => 'fa fa-calendar', 'iconOnly' => false)
            ]
        )->setLabel($this->trans('asbo.frontend.menu.main.ephemeride'));

        $menu->addChild('comite',
            [
                'route' => 'asbo_whoswho_comite_last',
                'linkAttributes' => array('title' => $this->trans('asbo.frontend.menu.main.comite')),
                'attributes' => array('class' => 'yellow'),
                'labelAttributes' => array('icon' => 'fa fa-group', 'iconOnly' => false)
            ]
        )->setLabel($this->trans('asbo.frontend.menu.main.comite'));

        $menu->addChild('contact',
            [
                'route' => 'homepage',
                'linkAttributes' => array('title' => $this->trans('asbo.frontend.menu.main.contact')),
                'attributes' => array('class' => 'green'),
                'labelAttributes' => array('icon' => 'fa fa-envelope', 'iconOnly' => false)
            ]
        )->setLabel($this->trans('asbo.frontend.menu.main.contact'));

        if ($this->securityContext->isGranted('ROLE_USER')) {
            $menu->addChild('logout', array(
                    'route' => 'fos_user_security_logout',
                    'linkAttributes' => array('title' => $this->trans('asbo.frontend.menu.main.logout')),
                    'labelAttributes' => array('icon' => 'fa fa-power-off', 'iconOnly' => false)
                ))->setLabel($this->trans('asbo.frontend.menu.main.logout'));
        } else {
            $menu->addChild('login', array(
                    'route' => 'fos_user_security_login',
                    'linkAttributes' => array('title' => $this->trans('asbo.frontend.menu.main.login')),
                    'labelAttributes' => array('icon' => 'fa fa-lock', 'iconOnly' => false)
                ))->setLabel($this->trans('asbo.frontend.menu.main.login'));
        }

        return $menu;
    }

    public function createMainSidebarMenu(Request $request)
    {
        $menu = $this->factory->createItem('asbo.frontend.menu.sidebar.main', array(
                'label' => $this->trans('asbo.frontend.menu.sidebar.main.title'),
                'childrenAttributes' => array(
                    'class' => 'unstyled list-unstyled'
                )
            ));

        $menu->setCurrentUri($request->getRequestUri());

        if ($this->securityContext->isGranted('ROLE_WHOSWHO_USER')) {

            $menu->addChild($this->createWhosWhoSidebarMenu($request));
        }

        if ($this->securityContext->isGranted('ROLE_USER')) {

            $menu->addChild('profile', array(
                    'route' => 'sonata_user_profile_show',
                    'linkAttributes' => array('title' => $this->trans('asbo.frontend.menu.sidebar.main.profile')),
                ))->setLabel($this->trans('asbo.frontend.menu.sidebar.main.profile'));

            $menu->addChild('message', array(
                    'route' => 'fos_message_inbox',
                    'linkAttributes' => array('title' => $this->trans('asbo.frontend.menu.sidebar.main.message')),
                ))->setLabel($this->trans('asbo.frontend.menu.sidebar.main.message').' ('.$this->asbo->getUser()->getUnreadMessages().')');

            $menu->addChild('events', array(
                    'route' => 'asbo_event_upcoming',
                    'linkAttributes' => array('title' => $this->trans('asbo.frontend.menu.sidebar.main.events')),
                ))->setLabel($this->trans('asbo.frontend.menu.sidebar.main.events'));
        }

        return $menu;

    }

    public function createAdminSidebarMenu(Request $request)
    {
        $menu = $this->factory->createItem('asbo.frontend.menu.sidebar.admin', array(
                'label' => $this->trans('asbo.frontend.menu.sidebar.admin.title'),
                'childrenAttributes' => array(
                    'class' => 'unstyled list-unstyled'
                )
            ));

        $menu->setCurrentUri($request->getRequestUri());

        if ($this->securityContext->isGranted('ROLE_ADMIN')) {

            $menu->addChild('administration', array(
                    'route' => 'sonata_admin_dashboard',
                    'linkAttributes' => array('title' => $this->trans('asbo.frontend.menu.sidebar.admin.dashboard')),
                ))->setLabel($this->trans('asbo.frontend.menu.sidebar.admin.dashboard'));

        }

        if ($this->securityContext->isGranted('ROLE_PREVIOUS_ADMIN')) {
            $menu->addChild('switch', array(
                    'route' => $request->attributes->get('_route'),
                    'routeParameters' => array_merge($request->attributes->get('_route_params'), array('_switch_user' => '_exit')),
                    'linkAttributes' => array('title' => $this->trans('asbo.frontend.menu.sidebar.admin.switch')),
                ))->setLabel($this->trans('asbo.frontend.menu.sidebar.admin.switch'));
        }

        return $menu;
    }

    public function createComiteAnnoSidebarMenu(Request $request)
    {
        $menu = $this->factory->createItem('asbo.frontend.menu.sidebar.comite.anno', array(
                'label' => $this->trans('asbo.frontend.menu.sidebar.comite.anno.title'),
                'childrenAttributes' => array(
                    'class' => 'nav nav-pills nav-stacked'
                )
            ));

        $menu->setCurrentUri($request->getRequestUri());

        foreach (array_reverse(AnnoManipulator::getAnnos()) as $anno) {
            $menu->addChild('anno_'.$anno, array(
                    'route' => 'asbo_whoswho_comite_anno',
                    'routeParameters' => ['anno' => $anno],
                    'linkAttributes' => array('title' => $this->trans('asbo.frontend.menu.sidebar.comite.anno.anno', ['%anno%' => $anno])),
                ))->setLabel($this->trans('asbo.frontend.menu.sidebar.comite.anno.anno', ['%anno%' => $anno]));
        }

        return $menu;

    }

    protected function createWhosWhoSidebarMenu(Request $request)
    {
        $menu = $this->factory->createItem('whoswho', array(
                'route' => 'asbo_whoswho_list',
                'linkAttributes' => array('title' => $this->trans('asbo.frontend.menu.sidebar.main.whoswho')),
                'label' => $this->trans('asbo.frontend.menu.sidebar.whoswho.title'),
                'childrenAttributes' => array(
                    'class' => 'unstyled list-unstyled'
                )
            ));

        $menu->setCurrentUri($request->getRequestUri());

        $fra = $this->fraHasUserManager->findOneBy(
            [
                'user' => $this->securityContext->getToken()->getUser(),
                'owner' => true
            ]
        );

        if (!empty($fra)) {
        $menu->addChild('owner', array(
                'route' => 'asbo_whoswho_fra_show',
                'routeParameters' => ['slug' => $fra->getFra()->getSlug()],
                'linkAttributes' => array('title' => $this->trans('asbo.frontend.menu.sidebar.whoswho.owner')),
            ))->setLabel($this->trans('asbo.frontend.menu.sidebar.whoswho.owner'));
        }

        $menu->addChild('list', array(
                'route' => 'asbo_whoswho_list',
                'linkAttributes' => array('title' => $this->trans('asbo.frontend.menu.sidebar.whoswho.list')),
            ))->setLabel($this->trans('asbo.frontend.menu.sidebar.whoswho.list'))
        ;

        $menu->addChild('search', array(
                'route' => 'asbo_whoswho_fra_search',
                'linkAttributes' => array('title' => $this->trans('asbo.frontend.menu.sidebar.whoswho.search')),
            ))->setLabel($this->trans('asbo.frontend.menu.sidebar.whoswho.search'))
        ;

        return $menu;

    }

    /**
     * Translate label.
     *
     * @param string $label
     * @param array  $parameters
     *
     * @return string
     */
    protected function trans($label, $parameters = array())
    {
        return $this->translator->trans($label, $parameters, 'menu');
    }
}
