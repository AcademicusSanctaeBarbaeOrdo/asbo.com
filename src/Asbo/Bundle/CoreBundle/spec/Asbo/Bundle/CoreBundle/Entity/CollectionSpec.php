<?php

namespace spec\Asbo\Bundle\CoreBundle\Entity;

use PhpSpec\ObjectBehavior;

class CollectionSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\CoreBundle\Entity\Collection');
    }

    public function it_extends_Sonata_collection()
    {
        $this->shouldHaveType('Sonata\ClassificationBundle\Entity\BaseCollection');
    }

    public function it_has_no_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }
}
