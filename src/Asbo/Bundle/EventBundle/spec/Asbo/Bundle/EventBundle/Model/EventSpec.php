<?php

namespace spec\Asbo\Bundle\EventBundle\Model;

use Asbo\Bundle\EventBundle\Model\CalendarInterface;
use DateTime;
use PhpSpec\ObjectBehavior;

class EventSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\EventBundle\Model\Event');
    }

    public function it_implements_Asbo_event_interface()
    {
        $this->shouldImplement('Asbo\Bundle\EventBundle\Model\EventInterface');
    }

    public function it_should_not_have_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    public function it_should_not_have_name_by_default()
    {
        $this->getName()->shouldReturn(null);
    }

    public function its_name_should_be_mutable()
    {
        $this->setName('Chapître');
        $this->getName()->shouldReturn('Chapître');
    }

    public function it_should_not_have_description_by_default()
    {
        $this->getDescription()->shouldReturn(null);
    }

    public function its_description_should_be_mutable()
    {
        $this->setDescription('A short description...');
        $this->getDescription()->shouldReturn('A short description...');
    }

    public function its_starts_at_should_be_mutable(DateTime $date)
    {
        $this->setStartsAt($date);
        $this->getStartsAt()->shouldReturn($date);
    }

    public function its_ends_at_should_be_mutable(DateTime $date)
    {
        $this->setEndsAt($date);
        $this->getEndsAt()->shouldReturn($date);
    }

    public function it_should_not_have_location_by_default()
    {
        $this->getLocation()->shouldReturn(null);
    }

    public function its_location_should_be_mutable()
    {
        $this->setLocation('LLN');
        $this->getLocation()->shouldReturn('LLN');
    }

    public function it_should_not_have_calendar_by_default()
    {
        $this->getCalendar()->shouldReturn(null);
    }

    public function its_calendar_should_be_mutable(CalendarInterface $calendar)
    {
        $this->setCalendar($calendar);
        $this->getCalendar()->shouldReturn($calendar);
    }

    public function it_should_not_have_status_by_default()
    {
        $this->getStatus()->shouldReturn(null);
    }

    public function its_status_can_take_only_specific_values()
    {
        $id = uniqid();
        $this->shouldThrow(new \InvalidArgumentException('Wrong event status supplied: "'.$id.'" given.'))->duringSetStatus($id);
    }


    public function its_status_should_be_muttable()
    {
        $this->setStatus('confirmed');
        $this->getStatus()->shouldReturn('confirmed');
    }

    public function it_is_convertable_to_string_and_returns_its_name()
    {
        $this->setName('Agapes');
        $this->__toString()->shouldReturn('Agapes');
    }

    public function it_has_no_created_date_by_default()
    {
        $this->getCreatedAt()->shouldReturn(null);
    }

    public function its_created_date_is_muttable()
    {
        $this->setCreatedAt($date = new \DateTime('now'));
        $this->getCreatedAt()->shouldReturn($date);
    }

    public function it_has_no_updated_date_by_default()
    {
        $this->getCreatedAt()->shouldReturn(null);
    }

    public function its_updated_date_is_muttable()
    {
        $this->setUpdatedAt($date = new \DateTime('now'));
        $this->getUpdatedAt()->shouldReturn($date);
    }

    public function it_has_fluent_interface(DateTime $date, CalendarInterface $calendar)
    {
        $this->setName('Agapes')->shouldReturn($this);
        $this->setDescription('A short description...')->shouldReturn($this);
        $this->setStartsAt($date)->shouldReturn($this);
        $this->setStartsAt($date)->shouldReturn($this);
        $this->setCalendar($calendar)->shouldReturn($this);
        $this->setStatus('confirmed')->shouldReturn($this);
    }
}
