<?php

namespace spec\Asbo\Bundle\QuizzBundle;

use PhpSpec\ObjectBehavior;

class AsboQuizzBundleSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\QuizzBundle\AsboQuizzBundle');
    }

    public function it_returns_correct_container_extension()
    {
        $this
            ->getContainerExtension()
            ->shouldHaveType('Asbo\Bundle\QuizzBundle\DependencyInjection\AsboQuizzExtension');
        ;
    }
}
