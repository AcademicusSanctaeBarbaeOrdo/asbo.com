<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Asbo\Bundle\WhosWhoBundle\Twig;

use PhpSpec\ObjectBehavior;

/**
 * Asbo who's who extension for Twig spec.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class AsboWhosWhoExtensionSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\WhosWhoBundle\Twig\AsboWhosWhoExtension');
    }

    public function it_is_a_Twig_extension()
    {
        $this->shouldHaveType('Twig_Extension');
    }
}
