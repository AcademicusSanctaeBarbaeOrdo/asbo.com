<?php

namespace spec\Asbo\Bundle\WhosWhoBundle\Entity;

use Asbo\Bundle\WhosWhoBundle\Model\Types\AddressTypes;
use PhpSpec\ObjectBehavior;

class AddressSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\WhosWhoBundle\Entity\Address');
    }

    public function it_has_no_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    public function it_has_no_address_by_default()
    {
        $this->getAddress()->shouldReturn(null);
    }

    public function its_address_is_mutable()
    {
        $this->setAddress('2004 Clay Lick Road, Denver, CO 80202');
        $this->getAddress()->shouldReturn('2004 Clay Lick Road, Denver, CO 80202');
    }

    public function it_has_no_type_by_default()
    {
        $this->getType()->shouldReturn(AddressTypes::HOME);
    }

    public function its_type_is_mutable()
    {
        $this->setType('kot');

        $this->getType()->shouldReturn('kot');
    }

    public function it_has_no_locality_by_default()
    {
        $this->getLocality()->shouldReturn(null);
    }

    public function its_locality_is_muttable()
    {
        $this->setLocality('LLN');
        $this->getLocality()->shouldReturn('LLN');
    }

    public function it_has_no_country_by_default()
    {
        $this->getCountry()->shouldReturn(null);
    }

    public function its_country_is_muttable()
    {
        $this->setCountry('Belgium');
        $this->getCountry()->shouldReturn('Belgium');
    }

    public function it_has_no_number_by_default()
    {
        $this->getNumber()->shouldReturn(null);
    }

    public function its_number_is_muttable()
    {
        $this->setNumber(58);
        $this->getNumber()->shouldReturn(58);
    }

    public function it_has_no_post_code_by_default()
    {
        $this->getPostCode()->shouldReturn(null);
    }

    public function its_post_code_is_muttable()
    {
        $this->setPostCode(1348);
        $this->getPostCode()->shouldReturn(1348);
    }

    public function it_has_no_street_by_default()
    {
        $this->getStreet()->shouldReturn(null);
    }

    public function its_street_is_muttable()
    {
        $this->setStreet('Rue des Wallons');
        $this->getStreet()->shouldReturn('Rue des Wallons');
    }

    public function it_has_no_state_by_default()
    {
        $this->getState()->shouldReturn(null);
    }

    public function its_state_is_muttable()
    {
        $this->setState('Nevada');
        $this->getState()->shouldReturn('Nevada');
    }

    public function it_has_no_district_by_default()
    {
        $this->getDistrict()->shouldReturn(null);
    }

    public function its_district_is_muttable()
    {
        $this->setDistrict('Paris');
        $this->getDistrict()->shouldReturn('Paris');
    }

    public function it_has_no_latitude_by_default()
    {
        $this->getLat()->shouldReturn(null);
    }

    public function its_latitude_is_muttable()
    {
        $this->setLat(50.66814620218402);
        $this->getLat()->shouldReturn(50.66814620218402);
    }

    public function its_latitude_return_a_float()
    {
        $this->setLat('50.66814620218402');
        $this->getLat()->shouldReturn(50.66814620218402);
    }

    public function it_has_no_longitude_by_default()
    {
        $this->getLng()->shouldReturn(null);
    }

    public function its_longitude_is_muttable()
    {
        $this->setLng(4.617603509400965);
        $this->getLng()->shouldReturn(4.617603509400965);
    }

    public function its_longitude_return_a_float()
    {
        $this->setLng('4.617603509400965');
        $this->getLng()->shouldReturn(4.617603509400965);
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

    public function it_can_return_a_string_representation()
    {
        $this->__toString()->shouldReturn('');
        $this->setAddress('Rue des Wallons 58, 1348 LLN');
        $this->__toString()->shouldReturn('Rue des Wallons 58, 1348 LLN');
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Fra $fra
     */
    public function it_has_fluent_interface($fra)
    {
        $this->setAddress(uniqid())->shouldReturn($this);
        $this->setType(uniqid())->shouldReturn($this);
        $this->setLocality(uniqid())->shouldReturn($this);
        $this->setCountry(uniqid())->shouldReturn($this);
        $this->setNumber(uniqid())->shouldReturn($this);
        $this->setPostCode(uniqid())->shouldReturn($this);
        $this->setStreet(uniqid())->shouldReturn($this);
        $this->setState(uniqid())->shouldReturn($this);
        $this->setDistrict(uniqid())->shouldReturn($this);
        $this->setLat(uniqid())->shouldReturn($this);
        $this->setLng(uniqid())->shouldReturn($this);
        $this->setFra($fra)->shouldReturn($this);
    }

}
