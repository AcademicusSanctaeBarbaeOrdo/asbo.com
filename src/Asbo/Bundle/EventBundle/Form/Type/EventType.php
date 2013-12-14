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

use Asbo\Bundle\CoreBundle\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Event form type.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class EventType extends AbstractType
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
                    'label' => 'asbo.form.event.name'
                )
            )
            ->add('description', 'textarea', array(
                    'label' => 'asbo.form.event.description'
                )
            )
            ->add('calendar', 'asbo_calendar_choice', array(
                    'label' => 'asbo.form.event.calendar_choice'
                )
            )
            ->add('startsAt', 'datetime', array(
                    'label' => 'asbo.form.event.starts_at'
                )
            )
            ->add('endsAt', 'datetime', array(
                    'label' => 'asbo.form.event.ends_at'
                )
            )
            ->add('location', 'textarea', array(
                    'label' => 'asbo.form.event.location'
                )
            )
            ->add('status', 'choice', array(
                    'choices' => Event::getStatusChoices(),
                    'label' => 'asbo.form.event.active'
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
            ->setDefaults(
                array(
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
        return 'asbo_event';
    }
}
