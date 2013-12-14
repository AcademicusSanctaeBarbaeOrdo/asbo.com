<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\CoreBundle\OAuth;

use Asbo\Bundle\CoreBundle\Entity\User;
use HWI\Bundle\OAuthBundle\Security\Core\Exception\AccountNotLinkedException;
use FOS\UserBundle\Model\UserInterface as FOSUserInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Loading and ad-hoc creation of a user by an OAuth sign-in provider account.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class UserProvider extends FOSUBUserProvider
{
    /**
     * {@inheritDoc}
     */
    public function connect(UserInterface $user, UserResponseInterface $response)
    {
        $this->updateUserByOAuthUserResponse($user, $response);

        $this->userManager->updateUser($user);
    }

    /**
     * {@inheritDoc}
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        $user = $this->userManager->findUserBy(
            array(
                $this->getProperty($response) => $response->getUsername()
            )
        );

        if (null === $user) {
            throw new AccountNotLinkedException(
                sprintf('Aucun compte n\'est lié à votre compte "%s".', $response->getResourceOwner()->getName())
            );
        }

        return $user;
    }

    /**
     * Attach OAuth sign-in provider account to existing user
     *
     * @param User                  $user
     * @param UserResponseInterface $response
     *
     * @throws \RuntimeException
     * @return FOSUserInterface
     */
    protected function updateUserByOAuthUserResponse(User $user, UserResponseInterface $response)
    {
        $propertyNameSetter = $this->getPropertyNameSetter($response);

        if (!method_exists($user, $propertyNameSetter)) {
            throw new \RuntimeException(
                sprintf("Class '%s' should have a method '%s'.", get_class($user), $propertyNameSetter)
            );
        }

        $user->$propertyNameSetter($response->getUsername());

        return $user;
    }

    /**
     * Returns the property name setter
     *
     * @param UserResponseInterface $response
     *
     * @return string
     */
    protected function getPropertyNameSetter(UserResponseInterface $response)
    {
        return sprintf('set%s', $this->getProperty($response));
    }

}
