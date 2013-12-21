<?php

namespace spec\Asbo\Bundle\ContactBundle;

use PhpSpec\ObjectBehavior;

class AsboContactBundleSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\ContactBundle\AsboContactBundle');
    }

    public function it_is_a_bundle()
    {
        $this->shouldHaveType('Symfony\Component\HttpKernel\Bundle\Bundle');
    }

    public function it_has_no_container_extension()
    {
        $this->getContainerExtension()->shouldReturn(false);
    }
}
