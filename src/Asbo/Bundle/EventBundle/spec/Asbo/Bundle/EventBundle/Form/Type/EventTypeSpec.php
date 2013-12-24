<?php

namespace spec\Asbo\Bundle\EventBundle\Form\Type;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EventTypeSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('Asbo\Bundle\EventBundle\Model\Event', array('asbo'));
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\EventBundle\Form\Type\EventType');
    }

    public function it_should_be_a_form_type()
    {
        $this->shouldHaveType('Symfony\Component\Form\AbstractType');
    }

    public function it_should_define_assigned_data_class(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(array(
                    'data_class'        => 'Asbo\Bundle\EventBundle\Model\Event',
                    'validation_groups' => array('asbo'),
                ))
            ->shouldBeCalled()
        ;

        $this->setDefaultOptions($resolver);
    }

    public function it_builds_form_with_name_and_description_field(FormBuilder $builder)
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

        $builder
            ->add('startsAt', 'datetime', Argument::any())
            ->shouldBeCalled()
            ->willReturn($builder)
        ;

        $builder
            ->add('endsAt', 'datetime', Argument::any())
            ->shouldBeCalled()
            ->willReturn($builder)
        ;

        $builder
            ->add('location', 'textarea', Argument::any())
            ->shouldBeCalled()
            ->willReturn($builder)
        ;

        $builder
            ->add('status', 'choice', Argument::any())
            ->shouldBeCalled()
            ->willReturn($builder)
        ;

        $builder
            ->add('calendar', 'asbo_calendar_choice', Argument::any())
            ->shouldBeCalled()
            ->willReturn($builder);

        $this->buildForm($builder, array());
    }

    public function it_has_valid_name()
    {
        $this->getName()->shouldReturn('asbo_event');
    }
}
