<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once __DIR__.'/AppKernel.php';

use Symfony\Bundle\FrameworkBundle\HttpCache\HttpCache;

class AppCache extends HttpCache
{
}
