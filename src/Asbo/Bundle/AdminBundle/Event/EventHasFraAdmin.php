<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\AdminBundle\Event;

use Asbo\Bundle\CoreBundle\Entity\EventHasFra;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * EventHasFra admin for SonataAdminBundle.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class EventHasFraAdmin extends Admin
{
    /**
     * {@inheritdoc}
     */
    protected $parentAssociationMapping = 'event';

    /**
     * {@inheritDoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('fra', 'sonata_type_model_list',
                [
                    'required' => true,
                ]
            )
            ->add('status', 'choice',
                [
                    'required' => true,
                    'choices' => EventHasFra::getStatusChoices(),
                ]
            )
        ;
    }

    /**
     * {@inheritDoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('image', 'string',
                [
                    'template' => 'AsboAdminBundle:Event:list_fra_custom_principal_image.html.twig',
                ]
            )
            ->addIdentifier('id', 'string',
                [
                    'code' => '__toString',
                ]
            )
            ->add('status', 'string',
                [
                    'template' => 'AsboAdminBundle:Event:list_event_has_fra_status.html.twig',
                ]
            )
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('status', 'doctrine_orm_choice',
                [
                    'field_type' => 'choice',
                    'field_options' => [
                        'choices' => EventHasFra::getStatusChoices(),
                    ],
                ]
            )
        ;
    }
}
