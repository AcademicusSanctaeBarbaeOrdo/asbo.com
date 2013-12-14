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
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Asbo\Bundle\WhosWhoBundle\Model\Types\PhoneTypes;

/**
 * Phone admin for SonataAdminBundle
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class PhoneAdmin extends Admin
{

    /**
     * {@inheritdoc}
     */
    protected $parentAssociationMapping = 'fra';

    /**
     * {@inheritDoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('number')
            ->add('type', 'choice',
                [
                    'choices' => PhoneTypes::getChoices(),
                ]
            )
            ->add('country', 'country',
                [
                    'preferred_choices' => [
                        'BE',
                        'FR',
                    ],
                ]
            )
        ;

        if (!$this->isChild()) {
            $formMapper->add('fra', 'sonata_type_model_list');
        }
    }

    /**
     * {@inheritDoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('fra')
            ->add('number')
            ->add('type', 'doctrine_orm_choice',
                [
                    'field_type' => 'choice',
                    'field_options' => [
                        'choices' => PhoneTypes::getChoices(),
                    ],
                ]
            )
            ->add('country', null,
                [
                    'field_type' => 'country'
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
            ->addIdentifier('number')
            ->add('getTypeLabel')
            ->add('getCountryCode')
        ;

        if (!$this->isChild()) {
            $listMapper->add('fra', 'sonata_type_model_list');
        }
    }
}
