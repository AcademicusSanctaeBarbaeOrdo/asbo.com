<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\CoreBundle\EventListener;

use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\SecurityContext;
use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;

/**
 * Login listener
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class LoginListener
{
    /**
     * @var \Doctrine\Bundle\DoctrineBundle\Registry $doctrine
     */
    protected $doctrine;

    /**
     * @var \Symfony\Component\HttpFoundation\Session\Session $session
     */
    protected $session;

    /**
     * @var \Symfony\Component\Security\Core\SecurityContext $context
     */
    protected $context;

    public function __construct(Doctrine $doctrine, Session $session, SecurityContext $context)
    {
        $this->doctrine  = $doctrine;
        $this->session   = $session;
        $this->context   = $context;
    }

    /**
     * Event called when a user is connect
     *
     * @param InteractiveLoginEvent $event
     */
    public function onLogin(InteractiveLoginEvent $event)
    {
        if ($this->context->isGranted('IS_AUTHENTICATED_FULLY')) {
            $this->session->getFlashBag()->add('success', 'Connexion effectuée avec succès !');
        }
    }
}
