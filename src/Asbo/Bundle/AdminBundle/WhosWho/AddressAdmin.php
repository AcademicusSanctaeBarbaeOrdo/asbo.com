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

use Asbo\Bundle\WhosWhoBundle\Model\Status\FraStatus;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Asbo\Bundle\WhosWhoBundle\Model\Types\AddressTypes;

/**
 * Address admin for SonataAdminBundle
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class AddressAdmin extends Admin
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
            ->add('address')
            ->add('type', 'choice',
                [
                    'required' => true,
                    'choices' => AddressTypes::getChoices(),
                ]
            )
            ->add('number')
            ->add('street')
            ->add('postcode')
            ->add('locality')
            ->add('country')
            ->add('state')
            ->add('district')
            ->add('lat', 'text',
                [
                    'required' => false,
                ]
            )
            ->add('lng', 'text',
                [
                    'required' => false,
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
            ->add('fra.status', 'doctrine_orm_choice',
                [
                    'field_type' => 'choice',
                    'field_options' => [
                        'choices' => FraStatus::getChoices(),
                    ],
                ]
            )
            ->add('address')
            ->add('number')
            ->add('street')
            ->add('postcode')
            ->add('locality')
            ->add('country')
            ->add('state')
            ->add('district')
            ->add('lat')
            ->add('lng')
            ->add('type', 'doctrine_orm_choice',
                [
                    'field_type' => 'choice',
                    'field_options' => [
                        'choices' => AddressTypes::getChoices(),
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
            ->addIdentifier('address')
            ->add('locality')
            ->add('postcode')
            ->add('country')
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

    /**
     * {@inheritdoc}
     */
    public function getExportFields()
    {
        $exports = parent::getExportFields();

        $exports[] = 'fra.firstname';
        $exports[] = 'fra.lastname';
        $exports[] = 'fra.nickname';
        $exports[] = 'fra.status';

        return $exports;
    }
}
