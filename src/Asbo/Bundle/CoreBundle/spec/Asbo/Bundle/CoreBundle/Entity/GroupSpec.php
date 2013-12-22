<?php

namespace spec\Asbo\Bundle\CoreBundle\Entity;

use PhpSpec\ObjectBehavior;

class GroupSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\CoreBundle\Entity\Group');
    }

    public function it_extends_FOS_group()
    {
        $this->shouldHaveType('Sonata\UserBundle\Entity\BaseGroup');
    }

    public function let()
    {
        $this->beConstructedWith('ROLE_ADMIN');
    }

    public function it_has_no_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }
}
