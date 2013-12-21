<?php

namespace spec\Asbo\Bundle\QuizzBundle\Entity;

use Asbo\Bundle\QuizzBundle\Model\QuizzTypes;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class QuizzSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\QuizzBundle\Entity\Quizz');
    }

    function it_has_no_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    function it_has_no_title_by_default()
    {
        $this->getTitle()->shouldReturn(null);
    }

    function its_title_is_mutable()
    {
        $this->setTitle('codex');
        $this->getTitle()->shouldReturn('codex');
    }

    function it_has_no_type_by_default()
    {
        $this->getType()->shouldReturn(null);
    }

    function its_type_is_mutable()
    {
        $this->setType(QuizzTypes::OPTIONAL);
        $this->getType()->shouldReturn(QuizzTypes::OPTIONAL);
    }

    function it_has_no_description_by_default()
    {
        $this->getDescription()->shouldReturn(null);
    }

    function its_description_is_mutable()
    {
        $this->setDescription('A short description.');
        $this->getDescription()->shouldReturn('A short description.');
    }

    public function it_is_convertable_to_string_and_returns_its_title()
    {
        $this->setTitle('Codex');
        $this->__toString()->shouldReturn('Codex');
    }

    function it_has_fluent_interface()
    {
        $this->setTitle('codex')->shouldReturn($this);
        $this->setType(QuizzTypes::OPTIONAL)->shouldReturn($this);
        $this->setDescription('A short description')->shouldReturn($this);
    }
}
