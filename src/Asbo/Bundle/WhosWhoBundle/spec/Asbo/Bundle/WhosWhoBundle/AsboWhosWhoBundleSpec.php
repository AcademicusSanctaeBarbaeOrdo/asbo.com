<?php

namespace spec\Asbo\Bundle\WhosWhoBundle;

use PhpSpec\ObjectBehavior;

class AsboWhosWhoBundleSpec extends ObjectBehavior
{
    public function it_is_a_bundle()
    {
        $this->shouldHaveType('Symfony\Component\HttpKernel\Bundle\Bundle');
    }
}
