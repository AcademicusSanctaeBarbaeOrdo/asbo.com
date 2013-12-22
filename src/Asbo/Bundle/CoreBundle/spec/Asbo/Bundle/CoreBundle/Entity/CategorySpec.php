<?php

namespace spec\Asbo\Bundle\CoreBundle\Entity;

use PhpSpec\ObjectBehavior;

class CategorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\CoreBundle\Entity\Category');
    }

    public function it_extends_Sonata_category()
    {
        $this->shouldHaveType('Sonata\ClassificationBundle\Entity\BaseCategory');
    }

    public function it_has_no_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }
}
