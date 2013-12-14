<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\ContactBundle;

use Asbo\Bundle\ContactBundle\DependencyInjection\AsboContactExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AsboContactBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function getContainerExtension()
    {
        return new AsboContactExtension();
    }
}
