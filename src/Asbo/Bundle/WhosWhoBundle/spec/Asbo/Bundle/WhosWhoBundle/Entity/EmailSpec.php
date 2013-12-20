<?php

namespace spec\Asbo\Bundle\WhosWhoBundle\Entity;

use Asbo\Bundle\WhosWhoBundle\Model\Types\EmailTypes;
use PhpSpec\ObjectBehavior;

class EmailSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\WhosWhoBundle\Entity\Email');
    }

    public function it_has_no_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    public function it_has_no_email_by_default()
    {
        $this->getEmail()->shouldReturn(null);
    }

    public function its_email_is_mutable()
    {
        $this->setEmail('foo@bar.baz');
        $this->getEmail()->shouldReturn('foo@bar.baz');
    }

    public function it_has_private_type_by_default()
    {
        $this->getType()->shouldReturn(EmailTypes::PRIVEE);
    }

    public function its_type_is_muttable()
    {
        $this->setType(EmailTypes::BOULOT);
        $this->getType()->shouldReturn(EmailTypes::BOULOT);
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

    public function it_is_convertable_to_string_and_returns_its_email()
    {
        $this->setEmail('foo@bar.baz');
        $this->__toString()->shouldReturn('foo@bar.baz');
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Fra $fra
     */
    public function it_has_fluent_interface($fra)
    {
        $this->setEmail('foo@bar.baz')->shouldReturn($this);
        $this->setType(EmailTypes::BOULOT)->shouldReturn($this);
        $this->setFra($fra)->shouldReturn($this);
    }
}
