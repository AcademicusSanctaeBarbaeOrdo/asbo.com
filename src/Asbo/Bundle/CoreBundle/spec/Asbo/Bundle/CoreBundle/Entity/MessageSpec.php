<?php

namespace spec\Asbo\Bundle\CoreBundle\Entity;

use PhpSpec\ObjectBehavior;

class MessageSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\CoreBundle\Entity\Message');
    }

    public function it_extends_FOS_message()
    {
        $this->shouldHaveType('FOS\MessageBundle\Entity\Message');
    }
}
