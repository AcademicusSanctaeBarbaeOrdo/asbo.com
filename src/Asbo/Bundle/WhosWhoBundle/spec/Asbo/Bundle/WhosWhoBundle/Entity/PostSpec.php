<?php

namespace spec\Asbo\Bundle\WhosWhoBundle\Entity;

use Asbo\Bundle\WhosWhoBundle\Model\Types\PostTypes;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PostSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\WhosWhoBundle\Entity\Post');
    }

    public function it_has_no_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    public function it_has_no_name_by_default()
    {
        $this->getName()->shouldReturn(null);
    }

    public function its_names_is_mutable()
    {
        $this->setName('Tyronum Mayor');
        $this->getName()->shouldReturn('Tyronum Mayor');
    }

    public function it_has_no_monogramme_by_default()
    {
        $this->getMonogramme()->shouldReturn(null);
    }

    function its_monogramme_is_mutable()
    {
        $this->setMonogramme('TM');
        $this->getMonogramme()->shouldReturn('TM');
    }

    function it_has_no_denier_by_default()
    {
        $this->getDenier()->shouldReturn(null);
    }

    function its_denier_is_mutable()
    {
        $this->setDenier(3);
        $this->getDenier()->shouldReturn(3);
    }

    function it_has_conseil_type_by_default()
    {
        $this->getType()->shouldReturn(PostTypes::CONSEIL);
    }

    function its_type_is_mutable()
    {
        $this->setType(PostTypes::COMISSION);
        $this->getType()->shouldReturn(PostTypes::COMISSION);
    }

    public function its_type_can_take_only_specific_values()
    {
        $id = uniqid();
        $this->shouldThrow(new \InvalidArgumentException('Wrong type, "'.$id.'" given.'))->duringSetType($id);
    }

    public function it_is_convertable_to_string_and_returns_its_name_and_monogramme()
    {
        $this->setName('Tyronum Mayor');
        $this->__toString()->shouldReturn('Tyronum Mayor');

        $this->setMonogramme('TM');
        $this->__toString()->shouldReturn('Tyronum Mayor (TM)');
    }

    public function it_has_fluent_interface()
    {
        $this->setName('Tyronum Mayor')->shouldReturn($this);
        $this->setDenier(3)->shouldReturn($this);
        $this->setMonogramme('TM')->shouldReturn($this);
        $this->setType(PostTypes::COMISSION)->shouldReturn($this);
    }
}
