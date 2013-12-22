<?php

namespace spec\Asbo\Bundle\CoreBundle\Entity;

use PhpSpec\ObjectBehavior;

class MessageMetadataSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\CoreBundle\Entity\MessageMetadata');
    }

    public function it_extends_FOS_message_metadata()
    {
        $this->shouldHaveType('FOS\MessageBundle\Entity\MessageMetaData');
    }
}
