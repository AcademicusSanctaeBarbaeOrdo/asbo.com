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

/**
 * ExternalPost admin for SonataAdminBundle.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class ExternalPostAdmin extends Admin
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
            ->add('where')
            ->add('position')
            ->add('date', 'asbo_whoswho_date_range',
                [
                    'virtual' => true,
                    'data_class' => $this->getClass(),
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
            ->add('where')
            ->add('position')
            ->add('dateBegin')
            ->add('dateEnd')
            ->add('fra')
        ;
    }

    /**
     * {@inheritDoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('position')
            ->add('where')
            ->add('dateBegin')
            ->add('dateEnd', null,
                [
                    'template' => 'AsboAdminBundle:WhosWho:current.html.twig'
                ]
            )
        ;

        if (!$this->isChild()) {
            $listMapper->add('fra', 'sonata_type_model_list');
        }
    }
}
