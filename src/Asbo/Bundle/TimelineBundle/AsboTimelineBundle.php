<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\TimelineBundle;

use Asbo\Bundle\TimelineBundle\DependencyInjection\AsboTimelineExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AsboTimelineBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function getContainerExtension()
    {
        return new AsboTimelineExtension();
    }
}
