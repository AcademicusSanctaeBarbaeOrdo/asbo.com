<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\EventBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Calendar form type.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class CalendarType extends AbstractType
{
    protected $dataClass;
    protected $validationGroups;

    /**
     * Constructor.
     */
    public function __construct($dataClass, array $validationGroups)
    {
        $this->dataClass = $dataClass;
        $this->validationGroups = $validationGroups;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                    'label' => 'asbo.form.calendar.name'
                )
            )
            ->add('description', 'textarea', array(
                    'label' => 'asbo.form.calendar.description'
                )
            )
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(array(
                    'data_class'        => $this->dataClass,
                    'validation_groups' => $this->validationGroups,
                )
            )
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'asbo_calendar';
    }
}
