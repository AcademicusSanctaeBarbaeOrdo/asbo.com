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

use FOS\MessageBundle\Provider\ProviderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

/**
 * User variables.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class UserVariables
{
    /**
     * The message provider.
     *
     * @var ProviderInterface
     */
    protected $provider;

    /**
     * The user form.
     *
     * @var FormInterface
     */
    protected $userForm;

    /**
     * Constructor.
     *
     * @param ProviderInterface $provider
     * @param FormInterface     $userForm
     */
    public function __construct(ProviderInterface $provider = null, FormInterface $userForm)
    {
        $this->provider = $provider;
        $this->userForm = $userForm;
    }

    /**
     * Get the user registration form service.
     *
     * @throws \Exception
     * @return FormView
     */
    public function getFormLogin()
    {
        if (null === $this->userForm) {
            throw new \Exception('Le bundle FOSUserBundle ne semble pas être installé !');
        }

        return $this->userForm->createView();
    }

    /**
     * Returns the number of unread messages.
     *
     * @throws \Exception
     * @return int
     */
    public function getUnreadMessages()
    {
        if (null === $this->provider) {
            throw new \Exception('Le bundle FOSMessageBundle ne semble pas être installé !');
        }

        return $this->provider->getNbUnreadMessages();
    }
}
