<?php

namespace spec\Asbo\Bundle\CoreBundle\Entity;

use PhpSpec\ObjectBehavior;

class GallerySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\CoreBundle\Entity\Gallery');
    }

    public function it_extends_Sonata_gallery()
    {
        $this->shouldHaveType('Sonata\MediaBundle\Entity\BaseGallery');
    }

    public function it_has_no_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    public function it_has_no_description_by_default()
    {
        $this->getDescription()->shouldReturn(null);
    }

    public function its_description_is_mutable()
    {
        $this->setDescription('A short description...');
        $this->getDescription()->shouldReturn('A short description...');
    }

    public function it_has_mutable_interface()
    {
        $this->setDescription('A short description')->shouldReturn($this);
    }
}
