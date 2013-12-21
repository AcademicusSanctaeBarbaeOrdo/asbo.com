<?php

namespace spec\Asbo\Bundle\QuizzBundle\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class QuizzAnnoSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\QuizzBundle\Entity\QuizzAnno');
    }

    function it_has_no_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    function it_has_no_anno_by_default()
    {
        $this->getAnno()->shouldReturn(null);
    }

    function its_anno_is_mutable()
    {
        $this->setAnno(24);
        $this->getAnno()->shouldReturn(24);
    }

    function it_has_no_weighting_by_default()
    {
        $this->getWeighting()->shouldreturn(null);
    }

    function its_wiehgting_is_mutable()
    {
        $this->setWeighting(20);
        $this->getWeighting()->shouldReturn(20);
    }

    function it_has_no_quizz_by_default()
    {
        $this->getQuizz()->shouldReturn(null);
    }

    /**
     * @param \Asbo\Bundle\QuizzBundle\Entity\Quizz $quizz
     */
    function its_quizz_is_mutable($quizz)
    {
        $this->setQuizz($quizz);
        $this->getQuizz()->shouldReturn($quizz);
    }

    function it_has_no_date_by_default()
    {
        $this->getDate()->shouldReturn(null);
    }

    function its_date_is_mutable()
    {
        $this->setDate($date = new \DateTime());
        $this->getDate()->shouldReturn($date);
    }

    function it_creates_quizz_anno_has_fra_collection_by_default()
    {
        $this->getQuizzAnnoHasFras()->shouldHaveType('Doctrine\\Common\\Collections\\Collection');
    }

    /**
     * @param \Asbo\Bundle\QuizzBundle\Entity\QuizzAnnoHasFra $quizzAnnoHasFra
     */
    function it_adds_fra_has_user_properly($quizzAnnoHasFra)
    {
        $this->getQuizzAnnoHasFras()->contains($quizzAnnoHasFra)->shouldReturn(false);

        $quizzAnnoHasFra->setQuizzAnno($this)->shouldBeCalled();

        $this->addQuizzAnnoHasFras($quizzAnnoHasFra);
        $this->getQuizzAnnoHasFras()->contains($quizzAnnoHasFra)->shouldReturn(true);
    }

    /**
     * @param \Asbo\Bundle\QuizzBundle\Entity\QuizzAnnoHasFra $quizzAnnoHasFra1
     * @param \Asbo\Bundle\QuizzBundle\Entity\QuizzAnnoHasFra $quizzAnnoHasFra2
     * @param \Asbo\Bundle\QuizzBundle\Entity\QuizzAnnoHasFra $quizzAnnoHasFra3
     */
    function it_calculate_average_of_quizz_by_fra($quizzAnnoHasFra1, $quizzAnnoHasFra2, $quizzAnnoHasFra3)
    {
        $this->getDefaultAverage()->shouldReturn(null);
        $this->getAverageOfWeighting(20)->shouldReturn(null);

        $quizzAnnoHasFra1->setQuizzAnno($this)->shouldBeCalled();
        $quizzAnnoHasFra2->setQuizzAnno($this)->shouldBeCalled();
        $quizzAnnoHasFra3->setQuizzAnno($this)->shouldBeCalled();

        $quizzAnnoHasFra1->getPoints()->shouldBeCalled();
        $quizzAnnoHasFra2->getPoints()->shouldBeCalled();
        $quizzAnnoHasFra3->getPoints()->shouldBeCalled();

        $quizzAnnoHasFra1->getPoints()->willReturn(10);
        $quizzAnnoHasFra2->getPoints()->willReturn(10);
        $quizzAnnoHasFra3->getPoints()->willReturn(16);

        $this->addQuizzAnnoHasFras($quizzAnnoHasFra1);
        $this->addQuizzAnnoHasFras($quizzAnnoHasFra2);
        $this->addQuizzAnnoHasFras($quizzAnnoHasFra3);

        $this->setWeighting(20);

        $this->getAverageOfWeighting(20)->shouldReturn((double) 12);
        $this->getDefaultAverage()->shouldReturn((double) 12);
    }

    /**
     * @param \Asbo\Bundle\QuizzBundle\Entity\Quizz $quizz
     */
    function it_is_convertable_to_string_and_returns_its_quizz_and_fra($quizz)
    {
        $quizz->getTitle()->shouldBeCalled();
        $quizz->getTitle()->willReturn('Codex');
        $this->setQuizz($quizz);
        $this->setAnno(24);

        $this->__toString()->shouldReturn('Codex - Anno 24');
    }

    /**
     * @param \Asbo\Bundle\QuizzBundle\Entity\Quizz $quizz
     * @param \Asbo\Bundle\QuizzBundle\Entity\QuizzAnnoHasFra $quizzAnnoHasFra
     */
    function it_has_fluent_interface($quizz, $quizzAnnoHasFra)
    {
        $this->setQuizz($quizz)->shouldReturn($this);
        $this->setAnno(24)->shouldReturn($this);
        $this->setWeighting(20)->shouldReturn($this);
        $this->setDate(new \DateTime())->shouldReturn($this);
        $this->addQuizzAnnoHasFras($quizzAnnoHasFra)->shouldReturn($this);
        $this->setQuizzAnnoHasFras(array($quizzAnnoHasFra))->shouldReturn($this);
    }
}
