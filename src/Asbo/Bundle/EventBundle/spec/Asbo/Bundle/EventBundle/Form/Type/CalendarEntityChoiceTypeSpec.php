<?php

namespace spec\Asbo\Bundle\EventBundle\Form\Type;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CalendarEntityChoiceTypeSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('Calendar');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\EventBundle\Form\Type\CalendarEntityChoiceType');
    }

    public function it_should_extends_Asbo_calendar_choice_type()
    {
        $this->shouldHaveType('Asbo\Bundle\EventBundle\Form\Type\CalendarChoiceType');
    }

    public function it_should_define_assigned_data_class(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(array(
                    'data_class' => 'Calendar',
                ))
            ->shouldBeCalled()
        ;

        $this->setDefaultOptions($resolver);
    }

    public function it_has_valid_name()
    {
        $this->getName()->shouldReturn('asbo_calendar_choice');
    }

    public function it_has_entity_parent()
    {
        $this->getParent()->shouldReturn('entity');
    }
}
