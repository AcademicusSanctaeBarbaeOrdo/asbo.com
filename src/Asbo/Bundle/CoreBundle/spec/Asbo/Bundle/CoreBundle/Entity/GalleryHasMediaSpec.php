<?php

namespace spec\Asbo\Bundle\CoreBundle\Entity;

use PhpSpec\ObjectBehavior;

class GalleryHasMediaSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\CoreBundle\Entity\GalleryHasMedia');
    }

    public function it_extends_Sonata_gallery_has_media()
    {
        $this->shouldHaveType('Sonata\MediaBundle\Entity\BaseGalleryHasMedia');
    }

    public function it_has_no_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }
}
