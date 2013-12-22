<?php

namespace spec\Asbo\Bundle\WhosWhoBundle\Entity;

use PhpSpec\ObjectBehavior;

class JobSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\WhosWhoBundle\Entity\Job');
    }

    public function it_has_no_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    public function it_has_no_company_by_default()
    {
        $this->getCompany()->shouldReturn(null);
    }

    public function its_company_is_mutable()
    {
        $this->setCompany('InBev');
        $this->getCompany()->shouldReturn('InBev');
    }

    public function it_has_no_sector_by_default()
    {
        $this->getSector()->shouldReturn(null);
    }

    public function its_sector_is_mutable()
    {
        $this->setSector('Beer');
        $this->getSector()->shouldReturn('Beer');
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

    public function it_has_no_position_by_default()
    {
        $this->getPosition()->shouldReturn(null);
    }

    public function its_position_is_muttable()
    {
        $this->setPosition('Président');
        $this->getPosition()->shouldReturn('Président');
    }

    public function it_has_no_begin_date_by_default()
    {
        $this->getDateBegin()->shouldReturn(null);
    }

    public function its_date_begin_is_mutable()
    {
        $this->setDateBegin($date = new \DateTime());
        $this->getDateBegin()->shouldReturn($date);
    }

    public function it_has_no_end_date_by_default()
    {
        $this->getDateEnd()->shouldReturn(null);
    }

    public function its_end_date_is_muttable()
    {
        $this->setDateEnd($date = new \DateTime());
        $this->getDateEnd()->shouldReturn($date);
    }

    public function it_is_current_post_if_end_date_is_null()
    {
        $this->shouldBeCurrent();

        $this->setDateEnd(new \DateTime());

        $this->shouldNotBeCurrent();
    }

    public function it_valid_date_when_end_date_is_less_than_begin_date()
    {
        $this->setDateBegin(new \DateTime('now'));
        $this->setDateEnd(new \DateTime('tomorrow'));

        $this->shouldBeDateBeginLessThanDateEnd();

        $this->setDateEnd(new \DateTime('yesterday'));
    }

    public function it_is_convertable_to_string_and_returns_its_job()
    {
        $this->setPosition('Président');
        $this->setCompany('InBev');
        $this->__toString()->shouldReturn('Président in InBev');
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Fra $fra
     */
    public function it_has_fluent_interface($fra)
    {
        $this->setFra($fra)->shouldReturn($this);
        $this->setCompany('InBev')->shouldReturn($this);
        $this->setSector('Beer')->shouldReturn($this);
        $this->setPosition('Président')->shouldReturn($this);
        $this->setDateBegin(new \DateTime())->shouldReturn($this);
        $this->setDateEnd(new \DateTime())->shouldReturn($this);
    }
}
