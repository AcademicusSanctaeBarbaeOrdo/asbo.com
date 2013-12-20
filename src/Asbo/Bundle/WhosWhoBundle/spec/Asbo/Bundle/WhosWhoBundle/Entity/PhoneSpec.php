<?php

namespace spec\Asbo\Bundle\WhosWhoBundle\Entity;

use Asbo\Bundle\WhosWhoBundle\Model\Types\PhoneTypes;
use PhpSpec\ObjectBehavior;

class PhoneSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\WhosWhoBundle\Entity\Phone');
    }

    public function it_has_no_number_by_default()
    {
        $this->getNumber()->shouldReturn(null);
    }

    public function its_number_is_mutable()
    {
        $this->setNumber('+32474123456');
        $this->getNumber()->shouldReturn('+32474123456');
    }

    public function its_type_is_gsm_by_default()
    {
        $this->getType()->shouldReturn(PhoneTypes::GSM);
    }

    public function its_type_is_mutable()
    {
        $this->setType(PhoneTypes::PRIVEE);
        $this->getType(PhoneTypes::PRIVEE);
    }

    public function it_has_no_country_by_default()
    {
        $this->getCountry()->shouldReturn(null);
    }

    public function its_country_is_mutable()
    {
        $this->setCountry('BE');
        $this->getCountry()->shouldReturn('BE');
    }

    public function it_has_no_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    public function it_has_no_fra_by_default()
    {
        $this->getFra()->shouldReturn(null);
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Fra $fra
     */
    public function its_fra_is_muttable($fra)
    {
        $this->setFra($fra);
        $this->getFra()->shouldReturn($fra);
    }

    public function it_is_convertable_to_string_and_returns_its_phone()
    {
        $this->setNumber('+32474123456');
        $this->__toString()->shouldReturn('+32474123456');
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Fra $fra
     */
    public function it_has_fluent_interface($fra)
    {
        $this->setFra($fra)->shouldReturn($this);
        $this->setCountry('BE')->shouldReturn($this);
        $this->setType(PhoneTypes::BOULOT)->shouldReturn($this);
        $this->setNumber('+32474123456')->shouldReturn($this);
    }
}
