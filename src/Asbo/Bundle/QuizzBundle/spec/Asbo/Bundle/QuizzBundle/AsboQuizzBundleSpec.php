<?php

namespace spec\Asbo\Bundle\QuizzBundle;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AsboQuizzBundleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\QuizzBundle\AsboQuizzBundle');
    }

    function it_returns_correct_container_extension()
    {
        $this
            ->getContainerExtension()
            ->shouldHaveType('Asbo\Bundle\QuizzBundle\DependencyInjection\AsboQuizzExtension');
        ;
    }
}
