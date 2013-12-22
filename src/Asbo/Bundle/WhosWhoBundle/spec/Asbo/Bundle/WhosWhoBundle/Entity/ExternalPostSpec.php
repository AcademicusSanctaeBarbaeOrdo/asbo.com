<?php

namespace spec\Asbo\Bundle\WhosWhoBundle\Entity;

use PhpSpec\ObjectBehavior;

class ExternalPostSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\WhosWhoBundle\Entity\ExternalPost');
    }

    public function it_has_no_id_by_default()
    {
        $this->getId()->shouldReturn(null);
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

    public function it_has_no_where_by_default()
    {
        $this->getWhere()->shouldReturn(null);
    }

    public function its_where_is_mutable()
    {
        $this->setWhere('CI');
        $this->getWhere()->shouldReturn('CI');
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
        $this->shouldNotBeDateBeginLessThanDateEnd();
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

    public function it_is_convertable_to_string_and_returns_its_positio_in_company()
    {
        $this->setPosition('Président');
        $this->setWhere('CI');
        $this->__toString()->shouldReturn('Président in CI');
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Fra $fra
     */
    public function it_has_fluent_interface($fra)
    {
        $this->setPosition('Prsident')->shouldReturn($this);
        $this->setFra($fra)->shouldReturn($this);
        $this->setDateBegin(new \DateTime())->shouldReturn($this);
        $this->setDateEnd(new \DateTime())->shouldReturn($this);
        $this->setWhere('CI')->shouldReturn($this);
    }
}
