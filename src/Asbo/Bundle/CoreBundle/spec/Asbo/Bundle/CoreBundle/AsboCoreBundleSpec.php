<?php

namespace spec\Asbo\Bundle\CoreBundle;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AsboCoreBundleSpec extends ObjectBehavior
{
    public function it_is_a_bundle()
    {
        $this->shouldHaveType('Symfony\Component\HttpKernel\Bundle\Bundle');
    }

    /**
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    public function it_add_properly_compiler_pass($container)
    {
        $container->addCompilerPass(Argument::any());

        $this->build($container);
    }
}
