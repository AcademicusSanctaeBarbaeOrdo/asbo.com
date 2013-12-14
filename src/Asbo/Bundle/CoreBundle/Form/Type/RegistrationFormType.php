<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\CoreBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Symfony\Component\Validator\Constraints\True;

/**
 * Registration form type
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'repeated', array(
                'type' => 'email',
                'options' => array(
                    'translation_domain' => 'FOSUserBundle',
                    'label' => 'form.email',
                ),
                'first_options' => array('label' => 'form.email'),
                'second_options' => array('label' => 'form.email_confirmation'),
                'translation_domain' => 'FOSUserBundle',
                'invalid_message' => 'fos_user.email.mismatch',
                )
            )
            ->add('plainPassword', 'repeated', array(
                    'type' => 'password',
                    'options' => array('translation_domain' => 'FOSUserBundle'),
                    'first_options' => array('label' => 'form.password'),
                    'second_options' => array('label' => 'form.password_confirmation'),
                    'invalid_message' => 'fos_user.password.mismatch',
                )
            )
            ->add('captcha', 'genemu_recaptcha', array(
                    'mapped' => false,
                )
            )
            ->add(
                'condition',
                'checkbox',
                array('mapped'      => false,
                    'constraints' => new true(array('message' => 'Veuillez accepter les conditions d\'utilisation'))
                )
            );
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'asbo_user_registration';
    }
}
