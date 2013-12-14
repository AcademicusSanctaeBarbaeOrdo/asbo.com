<?php

namespace spec\Asbo\Bundle\EventBundle\Form\Type;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CalendarTypeSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('Calendar', array('asbo'));
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\EventBundle\Form\Type\CalendarType');
    }

    public function it_should_be_a_form_type()
    {
        $this->shouldHaveType('Symfony\Component\Form\AbstractType');
    }

    public function it_builds_form_with_events_collection_and_name_and_description_field(FormBuilder $builder)
    {
        $builder
            ->add('name', 'text', Argument::any())
            ->shouldBeCalled()
            ->willReturn($builder)
        ;

        $builder
            ->add('description', 'textarea', Argument::any())
            ->shouldBeCalled()
            ->willReturn($builder)
        ;

        $this->buildForm($builder, array());
    }

    public function it_should_define_assigned_data_class(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(array(
                    'data_class'        => 'Calendar',
                    'validation_groups' => array('asbo'),
                ))
            ->shouldBeCalled()
        ;

        $this->setDefaultOptions($resolver);
    }

    public function it_has_valid_name()
    {
        $this->getName()->shouldReturn('asbo_calendar');
    }
}
