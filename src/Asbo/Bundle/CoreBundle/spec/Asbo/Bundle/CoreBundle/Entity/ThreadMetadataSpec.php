<?php

namespace spec\Asbo\Bundle\CoreBundle\Entity;

use PhpSpec\ObjectBehavior;

class ThreadMetadataSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\CoreBundle\Entity\ThreadMetadata');
    }

    public function it_extends_FOS_thread_metadata()
    {
        $this->shouldHaveType('FOS\MessageBundle\Entity\ThreadMetadata');
    }
}
