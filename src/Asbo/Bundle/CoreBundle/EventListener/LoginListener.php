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

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Login listener.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class LoginListener
{
    /**
     * @var Session $session
     */
    protected $session;

    /**
     * @var SecurityContextInterface $context
     */
    protected $context;

    /**
     * Constructor.
     *
     * @param Session                  $session
     * @param SecurityContextInterface $context
     */
    public function __construct(Session $session, SecurityContextInterface $context)
    {
        $this->session = $session;
        $this->context = $context;
    }

    /**
     * Event called when a user login.
     *
     * @param InteractiveLoginEvent $event
     */
    public function onLogin(InteractiveLoginEvent $event)
    {
        if ($this->context->isGranted('IS_AUTHENTICATED_FULLY')) {
            $this->session->getFlashBag()->add('success', $this->getFlashMessage($event->getAuthenticationToken()));
        }
    }

    /**
     * Return the formated flash message.
     *
     * @param TokenInterface $token
     *
     * @return string
     */
    protected function getFlashMessage(TokenInterface $token)
    {
        return sprintf('Bonjour %s !', $token->getUser()->getFullname());
    }
}
