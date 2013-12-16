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

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Logout\LogoutHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**
 * Logout listener.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class LogoutListener implements LogoutHandlerInterface
{
    /**
     * @var Session
     */
    protected $session;

    /**
     * Constructor.
     *
     * @param Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * {@inheritDoc}
     */
    public function logout(Request $request, Response $response, TokenInterface $token)
    {
        $this->session->getFlashBag()->add('success', $this->getFlashMessage($token));
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
        return sprintf('Au revoir %s !', $token->getUser()->getFullname());
    }
}
