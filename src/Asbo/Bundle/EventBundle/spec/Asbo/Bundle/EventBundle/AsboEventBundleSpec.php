<?php

namespace spec\Asbo\Bundle\EventBundle;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AsboEventBundleSpec extends ObjectBehavior
{
    public function it_is_a_bundle()
    {
        $this->shouldHaveType('Symfony\Component\HttpKernel\Bundle\Bundle');
    }
}
