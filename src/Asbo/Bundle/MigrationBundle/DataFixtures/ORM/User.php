<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\MigrationBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * Fra fixture
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class User extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Format the reference name of the given entity
     *
     * @param $entity \Asbo\Bundle\WhosWhoBundle\Entity\Fra
     * @return string
     */
    protected function formatReference($entity)
    {
        return 'user_'.$entity['id'];
    }

    /**
     * {@inheritdoc}
     */
    public function getSchemaClassName()
    {
        return 'Asbo\Bundle\MigrationBundle\Schema\User';
    }

    /**
     * {@inhertidoc}
     */
    public function getEntity(array $data)
    {
        $entity = new \Asbo\Bundle\CoreBundle\Entity\User();
        $entity = $this->setSalt($entity, $data['salt']);
        $entity
            ->setUsername($data['username'])
            ->setUsernameCanonical($data['username_canonical'])
            ->setEmail($data['email'])
            ->setEmailCanonical($data['email_canonical'])
            ->setEnabled($data['enabled'])
            ->setPassword($data['password'])
            ->setLocked($data['locked'])
            ->setExpired($data['expired'])
            ->setConfirmationToken($data['confirmation_token'])
            ->setPasswordRequestedAt($data['password_requested_at'])
            ->setRoles($data['roles'])
            ->setCredentialsExpired($data['credentials_expired'])
            ->setCredentialsExpireAt($data['credentials_expire_at'])
        ;

        $entity->setLastname($data['lastname']);
        $entity->setFirstname($data['firstname']);

        if ($data['last_login'] !== null) {
            $entity->setLastLogin($data['last_login']);
        }

        $this->setSalt($entity, $data['salt']);

        return $entity;
    }

    /**
     * @return \Asbo\Bundle\CoreBundle\Entity\User
     */
    protected function setSalt($entity, $salt)
    {
        $class = new \ReflectionClass(get_class($entity));
        $property = $class->getProperty('salt');
        $property->setAccessible(true);
        $property->setValue($entity, $salt);

        return $class->newInstance();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 0;
    }
}
