<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\WhosWhoBundle;

use Asbo\Bundle\WhosWhoBundle\DependencyInjection\AsboWhosWhoExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Bundle.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class AsboWhosWhoBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function getContainerExtension()
    {
        return new AsboWhosWhoExtension();
    }
}
