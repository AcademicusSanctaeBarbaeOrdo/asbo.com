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

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Asbo Contact Bundle.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class AsboContactBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function getContainerExtension()
    {
        return false;
    }
}
