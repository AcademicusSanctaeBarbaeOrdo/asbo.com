<?php

namespace spec\Asbo\Bundle\ContactBundle\Model;

use PhpSpec\ObjectBehavior;

class EnquirySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\ContactBundle\Model\Enquiry');
    }

    public function it_has_no_name_by_default()
    {
        $this->getName()->shouldReturn(null);
    }

    public function its_name_is_mutable()
    {
        $this->setName('John');
        $this->getName()->shouldReturn('John');
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

    public function it_has_no_subject_by_default()
    {
        $this->getSubject()->shouldReturn(null);
    }

    public function its_subject_is_mutable()
    {
        $this->setSubject('Hello !');
        $this->getSubject()->shouldReturn('Hello !');
    }

    public function it_has_no_body_by_default()
    {
        $this->getBody()->shouldReturn(null);
    }

    public function its_body_is_mutable()
    {
        $this->setBody('This is a message ...');
        $this->getBody()->shouldReturn('This is a message ...');
    }

    public function it_has_created_date_by_default()
    {
        $this->getCreatedAt()->shouldBeAnInstanceOf('\DateTime');
    }

    public function its_created_date_is_mutable()
    {
        $this->setCreatedAt($date = new \DateTime('+1day'));
        $this->getCreatedAt()->shouldReturn($date);
    }

    public function it_has_no_receiver_by_default()
    {
        $this->getReceiver()->shouldReturn(null);
    }

    public function its_receiver_is_mutable()
    {
        $this->setReceiver('foo@bar.baz');
        $this->getReceiver()->shouldReturn('foo@bar.baz');
    }

    public function its_can_convert_to_array()
    {
        $this->setName('John');
        $this->setEmail('foo@bar.baz');
        $this->setSubject('Name !');
        $this->setBody('This is a message ...');
        $this->setReceiver('baz@bar.foo');
        $this->setCreatedAt($date = new \DateTime());

        $this->toArray()->shouldReturn(
            [
                'name' => 'John',
                'email' => 'foo@bar.baz',
                'subject' => 'Name !',
                'body' => 'This is a message ...',
                'receiver' => 'baz@bar.foo',
                'createdAt' => $date->format('c')
            ]
        );
    }

    public function it_has_fluent_interface()
    {
        $this->setName('John')->shouldReturn($this);
        $this->setEmail('foo@bar.baz')->shouldReturn($this);
        $this->setSubject('Hello !')->shouldReturn($this);
        $this->setBody('This is a message ...')->shouldReturn($this);
        $this->setCreatedAt(new \Datetime())->shouldReturn($this);
    }
}
