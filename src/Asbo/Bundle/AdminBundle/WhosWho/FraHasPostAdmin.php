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

use Asbo\Bundle\WhosWhoBundle\Util\AnnoManipulator;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * FraHasPost admin for SonataAdminBundle.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class FraHasPostAdmin extends Admin
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
            ->add('post', 'sonata_type_model_list')
            ->add('date', 'asbo_whoswho_anno_text',
                [
                    'help' => "Ajouter ici l'anno s'il s'agit d'un post lors d'une année de student, sinon ajouter l'année civile !",
                ]
            );

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
            ->add('post')
            ->add('anno', null,
                [
                    'field_type' => 'choice',
                    'field_options' => ['choices' => AnnoManipulator::getAnnos()],
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
            ->addIdentifier('id')
            ->add('post')
            ->add('date', null,
                [
                    'template' => 'AsboAdminBundle:WhosWho:list_anno.html.twig',
                ]
            )
        ;

        if (!$this->isChild()) {
            $listMapper->add('fra', 'sonata_type_model_list');
        }
    }
}
