<?php

namespace spec\Asbo\Bundle\CoreBundle\Entity;

use PhpSpec\ObjectBehavior;

class ThreadSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\CoreBundle\Entity\Thread');
    }

    public function it_extends_FOS_thread()
    {
        $this->shouldHaveType('FOS\MessageBundle\Entity\Thread');
    }
}
