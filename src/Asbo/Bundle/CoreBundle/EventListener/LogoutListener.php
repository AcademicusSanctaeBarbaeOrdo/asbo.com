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

use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Http\Logout\LogoutHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**
 * Logout listener
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class LogoutListener implements LogoutHandlerInterface
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
     * {@inheritDoc}
     */
    public function logout(Request $request, Response $response, TokenInterface $token)
    {
        $this->session->getFlashBag()->add('success', 'Vous êtes bien déconnecté ! Au revoir !');
    }
}
