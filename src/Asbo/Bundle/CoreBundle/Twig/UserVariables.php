<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\CoreBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * User variables.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class UserVariables
{
    protected $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Get the  asbo.whoswho.form service
     *
     * @return form
     */
    public function getFormLogin()
    {
        // FOSUserBundle 2.0
        if ($this->container->has('fos_user.registration.form.factory')) {
            return $this->container->get('fos_user.registration.form.factory')->createForm()->createView();
        } elseif ($this->container->has('fos_user.registration.form')) {
            // FOSUserBundle 1.3
            return $this->container->get('fos_user.registration.form')->createView();
        } else {
            throw new \Exception('Le bundle FOSUserBundle ne semble pas être installé !');
        }
    }

    public function getUnreadMessages()
    {

        if ($this->container->has('fos_message.provider')) {
            return $this->container->get('fos_message.provider')->getNbUnreadMessages();
        } else {
            throw new \Exception('Le bundle FOSMessageBundle ne semble pas être installé !');
        }
    }
}
