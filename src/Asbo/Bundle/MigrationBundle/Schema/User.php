<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\MigrationBundle\Schema;

use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Schema of fra
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class User extends AbstractSchema
{
    /**
     * {@inhertidoc}
     */
    protected function setSchema(OptionsResolverInterface $resolver)
    {
        $resolver->setRequired(
            [
                'id',
                'username',
                'username_canonical',
                'email',
                'email_canonical',
                'enabled',
                'salt',
                'password',
                'last_login',
                'locked',
                'expired',
                'expires_at',
                'confirmation_token',
                'password_requested_at',
                'roles',
                'credentials_expired',
                'credentials_expire_at',
                'created_at',
                'updated_at',
                'firstname',
                'lastname'
            ]
        );
    }

    protected function setNormalizers(OptionsResolverInterface $resolver)
    {
        $resolver->setNormalizers(
            [
                'enabled' => function (Options $options, $value) {
                    return (bool) $value;
                },
                'locked' => function (Options $options, $value) {
                    return (bool) $value;
                },
                'credentials_expired' => function (Options $options, $value) {
                    return (bool) $value;
                },
                'expired' => function (Options $options, $value) {
                    return (bool) $value;
                },
                'expires_at' => function (Options $options, $value) {

                    if (!empty($value) && '0000-00-00' !== $value) {
                        return new \DateTime($value);
                    }

                    return null;
                },
                'password_requested_at' => function (Options $options, $value) {

                    if (!empty($value) && '0000-00-00' !== $value) {
                        return new \DateTime($value);
                    }

                    return null;
                },
                'credentials_expire_at' => function (Options $options, $value) {

                    if (!empty($value) && '0000-00-00' !== $value) {
                        return new \DateTime($value);
                    }

                    return null;
                },
                'roles' => function (Options $options, $value) {
                    return unserialize($value);
                },
                'last_login' => function (Options $options, $value) {

                    if ($value !== null) {
                        return new \DateTime($value);
                    }

                    return null;
                }
            ]
        );
    }
}
