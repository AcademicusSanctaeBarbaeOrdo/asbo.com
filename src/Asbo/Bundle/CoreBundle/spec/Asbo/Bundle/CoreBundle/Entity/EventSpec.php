<?php

namespace spec\Asbo\Bundle\CoreBundle\Entity;

use Asbo\Bundle\EventBundle\Model\Event;
use PhpSpec\ObjectBehavior;

class EventSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\CoreBundle\Entity\Event');
    }

    public function it_extends_Asbo_event()
    {
        $this->shouldHaveType('Asbo\Bundle\EventBundle\Model\Event');
    }

    public function it_has_no_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    public function its_status_is_confirmed_by_default()
    {
        $this->getStatus()->shouldReturn(Event::STATUS_CONFIRMED);
    }

    public function it_creates_event_has_fras_collection_by_default()
    {
        $this->getEventHasFras()->shouldHaveType('Doctrine\\Common\\Collections\\Collection');
    }

    public function it_has_no_event_has_fra_by_default()
    {
        $this->hasEventHasFras()->shouldReturn(false);
    }

    /**
     * @param \Asbo\Bundle\CoreBundle\Entity\EventHasFra $eventHasFra
     */
    public function it_add_event_has_fra_properly($eventHasFra)
    {
        $eventHasFra->setEvent($this)->shouldBeCalled();

        $this->addEventHasFra($eventHasFra);
        $this->hasEventHasFra($eventHasFra)->shouldReturn(true);
        $this->getEventHasFras()->shouldHaveCount(1);
        $this->addEventHasFra($eventHasFra);
        $this->getEventHasFras()->shouldHaveCount(1);
    }

    /**
     * @param \Asbo\Bundle\CoreBundle\Entity\EventHasFra $eventHasFra
     */
    public function it_remove_event_has_fra_properly($eventHasFra)
    {
        $this->hasEventHasFra($eventHasFra)->shouldReturn(false);
        $this->addEventHasFra($eventHasFra);
        $this->hasEventHasFra($eventHasFra)->shouldReturn(true);
        $this->getEventHasFras()->shouldHaveCount(1);

        $this->removeEventHasFra($eventHasFra);
        $this->hasEventHasFra($eventHasFra)->shouldReturn(false);
        $this->getEventHasFras()->shouldHaveCount(0);
    }

    /**
     * @param \Asbo\Bundle\CoreBundle\Entity\EventHasFra $eventHasFra1
     * @param \Asbo\Bundle\CoreBundle\Entity\EventHasFra $eventHasFra2
     */
    public function it_sets_event_has_fra_properly($eventHasFra1, $eventHasFra2)
    {
        $eventHasFra1->setEvent($this)->shouldBeCalled();
        $eventHasFra2->setEvent($this)->shouldBeCalled();

        $events = [$eventHasFra1, $eventHasFra2];

        $this->setEventHasFras($events);

        $this->getEventHasFras()->shouldHaveCount(2);
        $this->getEventHasFras()->shouldHaveType('Doctrine\\Common\\Collections\\Collection');
        $this->hasEventHasFra($eventHasFra1)->shouldReturn(true);
        $this->hasEventHasFra($eventHasFra2)->shouldReturn(true);
    }

    /**
     * @param \Asbo\Bundle\CoreBundle\Entity\EventHasFra $eventHasFra
     */
    public function it_has_fluent_interface($eventHasFra)
    {
        $this->addEventHasFra($eventHasFra)->shouldReturn($this);
        $this->removeEventHasFra($eventHasFra)->shouldReturn($this);
    }
}
