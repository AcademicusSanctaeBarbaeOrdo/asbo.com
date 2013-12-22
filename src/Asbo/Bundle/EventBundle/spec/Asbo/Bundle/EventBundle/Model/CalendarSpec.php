<?php

namespace spec\Asbo\Bundle\EventBundle\Model;

use Asbo\Bundle\EventBundle\Model\EventInterface;
use PhpSpec\ObjectBehavior;

class CalendarSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\EventBundle\Model\Calendar');
    }

    public function it_implements_Asbo_calendar_interface()
    {
        $this->shouldImplement('Asbo\Bundle\EventBundle\Model\CalendarInterface');
    }

    public function it_has_no_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    public function it_should_not_have_name_by_default()
    {
        $this->getName()->shouldReturn(null);
    }

    public function its_name_should_be_muttable()
    {
        $this->setName('ASBO Students');
        $this->getName()->shouldReturn('ASBO Students');
    }

    public function it_has_fluent_interface()
    {
        $this->setName('CAV')->shouldReturn($this);
    }

    public function it_should_not_have_description_by_default()
    {
        $this->getDescription()->shouldReturn(null);
    }

    public function it_should_initialize_events_collection_by_default()
    {
        $this->getEvents()->shouldHaveType('Doctrine\Common\Collections\Collection');
    }

    public function it_should_set_events_properly(EventInterface $event1, EventInterface $event2)
    {
        $event1->setCalendar($this)->shouldBeCalled();
        $event2->setCalendar($this)->shouldBeCalled();

        $this->setEvents(array($event1, $event2));

        $this->getEvents()->shouldHaveType('Doctrine\Common\Collections\Collection');
        $this->hasEvent($event1);
        $this->hasEvent($event2);

        $this->setEvents(array());
        $this->hasEvents()->shouldReturn(false);
    }

    public function it_should_add_events_properly(EventInterface $event)
    {
        $this->hasEvent($event)->shouldReturn(false);
        $this->hasEvents()->shouldReturn(false);

        $event->setCalendar($this)->shouldBeCalled();

        $this->addEvent($event);

        $this->hasEvent($event)->shouldReturn(true);
        $this->hasEvents()->shouldReturn(true);
    }

    public function it_should_remove_events_properly(EventInterface $event)
    {
        $this->hasEvent($event)->shouldReturn(false);
        $this->hasEvents()->shouldReturn(false);

        $event->setCalendar($this)->shouldBeCalled();
        $this->addEvent($event);

        $event->setCalendar(null)->shouldBeCalled();
        $this->removeEvent($event);

        $this->hasEvent($event)->shouldReturn(false);
        $this->hasEvents()->shouldReturn(false);
    }

    public function it_is_convertable_to_string_and_returns_its_name()
    {
        $this->setName('CAV');
        $this->__toString()->shouldReturn('CAV');
    }

    public function it_is_convertable_to_array_and_returns_array(EventInterface $event1, EventInterface $event2)
    {
        $this->setName('CAV');
        $this->setDescription('A short description...');

        $this->toArray()->shouldReturn(
            array(
                'name' => 'CAV',
                'description' => 'A short description...',
                'events' => array()
            )
        );

        $this->setEvents(array($event1, $event2));

        $this->toArray()->shouldReturn(
            array(
                'name' => 'CAV',
                'description' => 'A short description...',
                'events' => array(
                    $event1,
                    $event2
                )
            )
        );
    }

    public function its_description_should_be_mutable(EventInterface $event)
    {
        $this->setDescription('A short description...');
        $this->getDescription()->shouldReturn('A short description...');
        $this->addEvent($event)->shouldReturn($this);
        $this->setEvents(array($event))->shouldReturn($this);
    }
}
