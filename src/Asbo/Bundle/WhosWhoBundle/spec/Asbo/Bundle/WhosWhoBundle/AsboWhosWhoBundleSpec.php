<?php

namespace spec\Asbo\Bundle\WhosWhoBundle;

use PhpSpec\ObjectBehavior;

class AsboWhosWhoBundleSpec extends ObjectBehavior
{
    public function it_is_a_bundle()
    {
        $this->shouldHaveType('Symfony\Component\HttpKernel\Bundle\Bundle');
    }

    public function it_should_return_correct_extension()
    {
        $this
            ->getContainerExtension()
            ->shouldHaveType('Asbo\Bundle\WhosWhoBundle\DependencyInjection\AsboWhosWhoExtension')
        ;
    }
}
