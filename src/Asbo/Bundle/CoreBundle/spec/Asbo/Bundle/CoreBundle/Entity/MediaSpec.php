<?php

namespace spec\Asbo\Bundle\CoreBundle\Entity;

use PhpSpec\ObjectBehavior;

class MediaSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\CoreBundle\Entity\Media');
    }

    public function it_extends_Sonata_media()
    {
        $this->shouldHaveType('Sonata\MediaBundle\Entity\BaseMedia');
    }

    public function it_has_no_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }
}
