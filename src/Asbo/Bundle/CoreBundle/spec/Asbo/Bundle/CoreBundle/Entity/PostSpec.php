<?php

namespace spec\Asbo\Bundle\CoreBundle\Entity;

use PhpSpec\ObjectBehavior;

class PostSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\CoreBundle\Entity\Post');
    }

    public function it_extends_Sonata_post()
    {
        $this->shouldHaveType('Sonata\NewsBundle\Entity\BasePost');
    }

    public function it_has_no_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }
}
