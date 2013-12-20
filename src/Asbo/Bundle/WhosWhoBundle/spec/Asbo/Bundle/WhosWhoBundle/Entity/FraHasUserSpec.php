<?php

namespace spec\Asbo\Bundle\WhosWhoBundle\Entity;

use PhpSpec\ObjectBehavior;

class FraHasUserSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\WhosWhoBundle\Entity\FraHasUser');
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

    public function it_has_no_user_by_default()
    {
        $this->getFra()->shouldReturn(null);
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Model\FraUserInterface $user
     */
    public function its_user_is_muttable($user)
    {
        $this->setUser($user);
        $this->getUser()->shouldReturn($user);
    }

    public function it_is_owner_by_default()
    {
        $this->shouldBeOwner();
    }

    public function its_owner_is_mutable()
    {
        $this->setOwner(false);
        $this->shouldNotBeOwner();
    }

    public function it_has_no_updated_at_by_default()
    {
        $this->getUpdatedAt()->shouldReturn(null);
    }

    public function its_updated_at_is_muttable()
    {
        $this->setUpdatedAt($date = new \DateTime());
        $this->getUpdatedAt()->shouldReturn($date);
    }

    public function it_has_no_created_at_by_default()
    {
        $this->getCreatedAt()->shouldReturn(null);
    }

    public function its_created_at_is_muttable()
    {
        $this->setCreatedAt($date = new \DateTime());
        $this->getCreatedAt()->shouldReturn($date);
    }

    public function it_update_created_at_and_updated_at_when_entity_is_persist()
    {
        $this->prePersist();
        $this->getCreatedAt()->shouldHaveType('DateTime');
        $this->getUpdatedAt()->shouldHaveType('DateTime');
    }

    public function it_update_updated_at_when_entity_is_updated()
    {
        $this->preUpdate();
        $this->getUpdatedAt()->shouldHaveType('DateTime');
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Fra             $fra
     * @param \Asbo\Bundle\WhosWhoBundle\Model\FraUserInterface $user
     */
    public function it_is_convertable_to_string_and_returns_its_user_and_fra($fra, $user)
    {
        $fra->__toString()->shouldBeCalled();
        $fra->__toString()->willReturn('Malian De Ron');

        $user->__toString()->shouldBeCalled();
        $user->__toString()->willReturn('Yoplaboum');

        $this->setFra($fra);
        $this->setUser($user);

        $this->__toString('Yoplaboum | Malian De Ron');
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Fra             $fra
     * @param \Asbo\Bundle\WhosWhoBundle\Model\FraUserInterface $user
     */
    public function it_has_fluent_interface($fra, $user)
    {
        $this->setFra($fra)->shouldReturn($this);
        $this->setUser($user)->shouldReturn($this);
        $this->setOwner(true)->shouldReturn($this);
        $this->setUpdatedAt(new \DateTime())->shouldReturn($this);
        $this->setCreatedAt(new \DateTime())->shouldReturn($this);
    }
}
