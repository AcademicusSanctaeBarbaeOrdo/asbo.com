<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\AdminBundle\Quizz;

use Asbo\Bundle\WhosWhoBundle\Util\AnnoManipulator;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * QuizzAnno admin for SonataAdminBundle.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class QuizzAnnoAdmin extends Admin
{
    /**
     * {@inheritDoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $weighting = range(10, 100, 10);

        $formMapper
            ->add('quizz', 'sonata_type_model_list')
            ->add('anno', 'asbo_whoswho_anno')
            ->add('weighting', 'choice',
                [
                    'choices' => array_combine($weighting, $weighting),
                ]
            )
            ->add('date', 'date')
            ->add('quizzAnnoHasFras', 'sonata_type_collection',
                [
                    'cascade_validation' => true,
                    'by_reference' => false,
                ],
                [
                    'edit' => 'inline',
                    'inline' => 'table',
                    'admin_code' => 'asbo.quizz.admin.quizz_anno_has_fra',
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
            ->addIdentifier('anno', 'string',
                [
                    'code' => '__toString',
                ]
            )
            ->add('date')
            ->add('weighting')
            ->add('averageOfWeighting')
            ->add('defaultAverage')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getNewInstance()
    {
        $quizz = parent::getNewInstance()
            ->setAnno(AnnoManipulator::getCurrentAnno())
            ->setWeighting(20)
            ->setDate(new \DateTime())
        ;

        return $quizz;
    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate($object)
    {
        $object->setQuizzAnnoHasFras($object->getQuizzAnnoHasFras());
    }

    /**
     * {@inheritdoc}
     */
    public function prePersist($object)
    {
        $object->setQuizzAnnoHasFras($object->getQuizzAnnoHasFras());
    }
}
