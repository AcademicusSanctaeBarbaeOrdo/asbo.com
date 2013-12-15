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
use Asbo\Bundle\WhosWhoBundle\Model\Types\EmailTypes;

/**
 * Email admin for SonataAdminBundle.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class EmailAdmin extends Admin
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
            ->add('email')
            ->add('type', 'choice',
                [
                    'choices' => EmailTypes::getChoices(),
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
            ->add('email')
            ->add('type', null,
                [
                    'field_type' => 'choice',
                    'field_options' => [
                        'choices' => EmailTypes::getChoices(),
                    ],
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
            ->addIdentifier('email')
            ->add('typeLabel', 'text',
                [
                    'label' => 'Type',
                ]
            )
        ;

        if (!$this->isChild()) {
            $listMapper->add('fra', 'sonata_type_model_list');
        }
    }
}
