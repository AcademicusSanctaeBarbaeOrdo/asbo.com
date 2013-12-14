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
use Asbo\Bundle\WhosWhoBundle\Model\Types\PostTypes;

/**
 * Post admin for SonataAdminBundle
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class PostAdmin extends Admin
{
    /**
     * {@inheritDoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('monogramme')
            ->add('type', 'choice',
                [
                    'choices' => PostTypes::getChoices(),
                ]
            )
            ->add('denier')
        ;
    }

    /**
     * {@inheritDoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('monogramme')
            ->add('type', 'doctrine_orm_choice',
                [
                    'field_type' => 'choice',
                    'field_options' => [
                        'choices' => PostTypes::getChoices(),
                    ],
                ]
            )
            ->add('denier')
        ;
    }

    /**
     * {@inheritDoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('monogramme')
            ->add('type')
            ->add('denier')
        ;
    }
}
