<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\WhosWhoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Settings form type.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class SettingsType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('whoswho', 'checkbox',
                [
                    'required' => false,
                ]
            )
            ->add('pereat', 'checkbox',
                [
                    'required' => false,
                ]
            )
            ->add('convoc_externe', 'checkbox',
                [
                    'required' => false,
                ]
            )
            ->add('convoc_banquet', 'checkbox',
                [
                    'required' => false,
                ]
            )
            ->add('convoc_we', 'checkbox',
                [
                    'required' => false,
                ]
            )
            ->add('convoc_ephemerides_q1', 'checkbox',
                [
                    'required' => false,
                ]
            )
            ->add('convoc_ephemerides_q2', 'checkbox',
                [
                    'required' => false,
                ]
            )
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'asbo_whoswho_fra_settings';
    }
}
