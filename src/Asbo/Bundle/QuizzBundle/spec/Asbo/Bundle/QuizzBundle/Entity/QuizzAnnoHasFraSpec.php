<?php

namespace spec\Asbo\Bundle\QuizzBundle\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class QuizzAnnoHasFraSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\QuizzBundle\Entity\QuizzAnnoHasFra');
    }

    function it_has_no_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    function it_has_no_quizz_anno_by_default()
    {
        $this->getQuizzAnno()->shouldReturn(null);
    }

    /**
     * @param \Asbo\Bundle\QuizzBundle\Entity\QuizzAnno $quizzAnno
     */
    function its_quizz_anno_is_muttable($quizzAnno)
    {
        $this->setQuizzAnno($quizzAnno);
        $this->getQuizzAnno()->shouldReturn($quizzAnno);
    }

    function it_has_no_fra_by_default()
    {
        $this->getFra()->shouldReturn(null);
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Fra $fra
     */
    function its_fra_is_mutable($fra)
    {
        $this->setFra($fra);
        $this->getFra()->shouldReturn($fra);
    }

    function it_has_no_points_by_default()
    {
        $this->getPoints()->shouldReturn(null);
    }

    function its_points_is_mutable()
    {
        $this->setPoints(20);
        $this->getPoints()->shouldReturn(20);
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Fra $fra
     * @param \Asbo\Bundle\QuizzBundle\Entity\QuizzAnno $quizzAnno
     * @param \Symfony\Component\Validator\ExecutionContextInterface $context
     */
    public function it_valid_entity($quizzAnno, $fra, $context)
    {
        $this->setPoints(-25);

        $context->addViolationAt('points', "Une note négative n'est pas autorisée.", array(), null)->shouldBeCalled();

        $this->isValid($context);

        $this->setPoints(35);
        $quizzAnno->getWeighting()->willReturn(20);
        $this->setQuizzAnno($quizzAnno);
        $context->addViolationAt('points', "Une note supérieur à la pondération de l'interrogation ({{ ponderation }}) n'est pas autorisée.", ['{{ ponderation }}' => 20], null)->shouldBeCalled();

        $this->isValid($context);

        $this->setFra($fra);
        $context->addViolationAt('points', "L'anno du fra ({{ fra }}) doit correspondre à l'anno de l'interrogation ({{ interro }}).", ['{{ fra }}' => 24, '{{ interro }}' => 27], null)->shouldBeCalled();
        $quizzAnno->getAnno()->willReturn(27);
        $fra->getAnno()->willReturn(24);

        $this->isValid($context);

    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Fra $fra
     * @param \Asbo\Bundle\QuizzBundle\Entity\QuizzAnno $quizzAnno
     * @param \Asbo\Bundle\QuizzBundle\Entity\Quizz $quizz
     */
    public function it_is_convertable_to_string_and_returns_its_quizz_and_fra($fra, $quizzAnno, $quizz)
    {
        $fra->__toString()->shouldBeCalled();
        $quizzAnno->getQuizz()->shouldBeCalled();
        $quizz->getTitle()->shouldBeCalled();

        $fra->__toString()->willReturn('Malian');
        $quizzAnno->getQuizz()->willReturn($quizz);
        $quizz->getTitle()->willReturn('Codex');

        $this->setQuizzAnno($quizzAnno);
        $this->setFra($fra);

        $this->__toString()->shouldReturn('Interrogation - Codex - Malian');
    }

    /**
     * @param \Asbo\Bundle\QuizzBundle\Entity\QuizzAnno $quizzAnno
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Fra $fra
     */
    function it_has_fluent_interface($quizzAnno, $fra)
    {
        $this->setQuizzAnno($quizzAnno)->shouldReturn($this);
        $this->setFra($fra)->shouldReturn($this);
        $this->setPoints(20)->shouldReturn($this);
    }
}
