<?php

namespace spec\Asbo\Bundle\CoreBundle\Entity;

use Asbo\Bundle\CoreBundle\Entity\EventHasFra;
use PhpSpec\ObjectBehavior;

class EventHasFraSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\CoreBundle\Entity\EventHasFra');
    }

    public function it_has_no_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    public function it_has_no_event_by_default()
    {
        $this->getEvent()->shouldReturn(null);
    }

    /**
     * @param \Asbo\Bundle\EventBundle\Model\Event $event
     */
    public function it_event_is_mutable($event)
    {
        $this->setEvent($event);
        $this->getEvent()->shouldReturn($event);
    }

    public function it_has_no_fra_by_default()
    {
        $this->getFra()->shouldReturn(null);
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Fra $fra
     */
    public function it_fra_is_mutable($fra)
    {
        $this->setFra($fra);
        $this->getFra()->shouldReturn($fra);
    }

    public function it_has_no_status_by_default()
    {
        $this->getStatus()->shouldReturn(null);
    }

    public function its_status_is_mutable()
    {
        $this->setStatus(EventHasFra::STATUS_DECLINE);
        $this->getStatus()->shouldReturn(EventHasFra::STATUS_DECLINE);
    }

    public function it_return_status_choice()
    {
        self::getStatusChoices()->shouldBeArray();
        self::getStatusChoices()->shouldHaveCount(3);
        self::getStatusChoices()->shouldHaveKeys([EventHasFra::STATUS_JOIN, EventHasFra::STATUS_DECLINE, EventHasFra::STATUS_MAYBE]);
    }

    public function it_return_a_callback_validation()
    {
        self::getCallbackValidation()->shouldBeArray();
        self::getCallbackValidation()->shouldHaveCount(3);
        self::getCallbackValidation()->shouldHaveValues([EventHasFra::STATUS_JOIN, EventHasFra::STATUS_DECLINE, EventHasFra::STATUS_MAYBE]);
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Fra $fra
     */
    public function it_is_convertable_to_string_and_returns_its_fra($fra)
    {
        $fra->__toString()->willReturn('Malian');
        $this->setFra($fra);
        $this->__toString()->shouldReturn('Malian');
    }

    /**
     * @param \Asbo\Bundle\EventBundle\Model\Event  $event
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Fra $fra
     */
    public function it_has_fluent_interface($event, $fra)
    {
        $this->setEvent($event)->shouldReturn($this);
        $this->setFra($fra)->shouldReturn($this);
        $this->setStatus(EventHasFra::STATUS_JOIN)->shouldReturn($this);
    }

    public function getMatchers()
    {
        return [
            'haveKeys' => function ($subject, $keys) {
                    foreach ($keys as $key) {
                        if (!array_key_exists($key, $subject)) {
                            return false;
                        }
                    }

                    return true;
                },
            'haveValues' => function ($subject, $values) {
                    foreach ($values as $value) {
                        if (!in_array($value, $subject)) {
                            return false;
                        }
                    }

                    return true;
                },
        ];
    }

}
