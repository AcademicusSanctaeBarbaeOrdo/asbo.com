<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\AdminBundle\WhosWho;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

/**
 * Diploma admin for SonataAdminBundle
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class SettingsAdmin extends Admin
{
    /**
     * {@inheritDoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('whoswho', null,
                [
                    'required' => false,
                ]
            )
            ->add('pereat', null,
                [
                    'required' => false,
                ]
            )
            ->add('convoc_externe', null,
                [
                    'required' => false,
                ]
            )
            ->add('convoc_banquet', null,
                [
                    'required' => false,
                ]
            )
            ->add('convoc_we', null,
                [
                    'required' => false,
                ]
            )
            ->add('convoc_ephemerides_q1', null,
                [
                    'required' => false,
                ]
            )
            ->add('convoc_ephemerides_q2', null,
                [
                    'required' => false,
                ]
            )
        ;
    }

    /**
     * {@inheritDoc}
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->remove('delete')
            ->remove('list')
            ->remove('create')
        ;
    }
}
