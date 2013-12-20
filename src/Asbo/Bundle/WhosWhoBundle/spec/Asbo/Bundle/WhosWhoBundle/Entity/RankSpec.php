<?php

namespace spec\Asbo\Bundle\WhosWhoBundle\Entity;

use PhpSpec\ObjectBehavior;

class RankSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\WhosWhoBundle\Entity\Rank');
    }

    public function it_has_no_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    public function it_has_no_name_by_default()
    {
        $this->getName()->shouldReturn(null);
    }

    public function its_name_is_mutable()
    {
        $this->setName('Roi des Bleus');
        $this->getName('Roi des Bleus');
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

    public function it_is_convertable_to_string_and_returns_its_name()
    {
        $this->setName('Roi des Bleus');
        $this->__toString()->shouldReturn('Roi des Bleus');
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Fra $fra
     */
    public function it_has_fluent_interface($fra)
    {
        $this->setFra($fra)->shouldReturn($this);
        $this->setName('Roi des Bleus')->shouldReturn($this);
    }
}
