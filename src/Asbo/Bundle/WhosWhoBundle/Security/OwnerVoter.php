<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\WhosWhoBundle\Security;

use Asbo\Bundle\WhosWhoBundle\Entity\Fra;
use Asbo\Bundle\WhosWhoBundle\Entity\FraHasUser;
use Asbo\Bundle\WhosWhoBundle\Model\FraResourceInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Voter.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class OwnerVoter implements VoterInterface
{
    /**
     * {@inheritdoc}
     */
    public function supportsAttribute($attribute)
    {
        return 'ROLE_WHOSWHO_FRA_MANAGE' === $attribute;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsClass($class)
    {
        return $class instanceof Fra || $class instanceof FraResourceInterface;
    }

    /**
     * {@inheritdoc}
     */
    public function vote(TokenInterface $token, $object, array $attributes)
    {
        $vote = self::ACCESS_ABSTAIN;

        foreach ($attributes as $attribute) {

            if (!$this->supportsAttribute($attribute) || !$this->supportsClass($object)) {
                continue;
            }

            if ($object instanceof FraResourceInterface) {
                $object = $object->getFra();
            }

            $vote = self::ACCESS_DENIED;

            /** @var \Asbo\Bundle\WhosWhoBundle\Entity\Fra $object */
            foreach ($object->getFraHasUsers() as $user) {
                if ($this->canManage($user, $token->getUser())) {
                    $vote = self::ACCESS_GRANTED;
                    break;
                }
            }
        }

        return $vote;
    }

    /**
     * Verifies that the user is the owner.
     *
     * @param  FraHasUser $fra
     * @param  mixed      $user
     * @return boolean
     */
    protected function canManage(FraHasUser $fra, $user)
    {
        if ($fra->getUser() instanceof EquatableInterface && $user instanceof UserInterface) {
            return $fra->getUser()->isEqualTo($user);
        }

        return $fra->getUser() === $user;
    }
}
