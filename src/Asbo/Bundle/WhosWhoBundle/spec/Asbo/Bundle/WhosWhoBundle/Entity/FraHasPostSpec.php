<?php

namespace spec\Asbo\Bundle\WhosWhoBundle\Entity;

use PhpSpec\ObjectBehavior;

class FraHasPostSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\WhosWhoBundle\Entity\FraHasPost');
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

    public function it_has_no_post_by_default()
    {
        $this->getPost()->shouldReturn(null);
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Post $post
     */
    public function its_post_is_muttable($post)
    {
        $this->setpost($post);
        $this->getPost()->shouldReturn($post);
    }

    public function it_has_no_anno_by_default()
    {
        $this->getAnno()->shouldReturn(null);
    }

    public function its_anno_is_mutable()
    {
        $this->setAnno(24);
        $this->getAnno()->shouldReturn(24);
    }

    public function it_has_no_civil_year_by_default()
    {
        $this->getCivilYear()->shouldReturn(null);
    }

    public function its_civil_year_is_mutable()
    {
        $this->setCivilYear($date = new \DateTime());
        $this->getCivilYear()->shouldReturn($date);
    }

    public function it_has_no_civil_year_when_anno_is_set_and_inverse()
    {
        $this->setCivilYear(new \DateTime());
        $this->setAnno(27);
        $this->getCivilYear()->shouldReturn(null);
        $this->getAnno()->shouldReturn(27);
        $this->setCivilYear($date = new \DateTime());
        $this->getAnno()->shouldReturn(null);
        $this->getCivilYear()->shouldReturn($date);
    }

    public function it_has_no_date_by_default()
    {
        $this->getDate()->shouldReturn(null);
    }

    public function its_date_is_muttable()
    {
        $this->setDate($date = new \DateTime());
        $this->getDate()->shouldReturn($date);
        $this->getCivilYear()->shouldReturn($date);
        $this->getAnno()->shouldReturn(null);

        $this->setDate(24);
        $this->getDate()->shouldReturn(24);
        $this->getAnno()->shouldReturn(24);
        $this->getCivilYear()->shouldReturn(null);
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Post $post
     */
    public function it_is_convertable_to_string_and_returns_its_post($post)
    {
        $post->__toString()->shouldBeCalled();
        $post->__toString()->willReturn('TM');

        $this->setPost($post);
        $this->__toString()->shouldReturn('TM');
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Fra $fra
     *  @param \Asbo\Bundle\WhosWhoBundle\Entity\Post $post
     */
    public function it_has_fluent_interface($fra, $post)
    {
        $this->setFra($fra)->shouldReturn($this);
        $this->setPost($post)->shouldReturn($this);
        $this->setAnno(24)->shouldReturn($this);
        $this->setDate(24)->shouldReturn($this);
        $this->setCivilYear(new \DateTime())->shouldReturn($this);
    }
}
