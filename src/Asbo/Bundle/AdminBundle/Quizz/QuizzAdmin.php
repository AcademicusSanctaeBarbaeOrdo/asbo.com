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

use Asbo\Bundle\QuizzBundle\Model\QuizzTypes;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Quizz admin for SonataAdminBundle.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class QuizzAdmin extends Admin
{
    /**
     * {@inheritDoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title')
            ->add('type', 'choice',
                [
                    'required' => true, 'choices' => QuizzTypes::getChoices(),
                ]
            )
            ->add('description')
        ;
    }

    /**
     * {@inheritDoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('type')
            ->add('description')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getNewInstance()
    {
        $quizz = parent::getNewInstance()
            ->setType(QuizzTypes::REQUIRED)
        ;

        return $quizz;
    }
}
