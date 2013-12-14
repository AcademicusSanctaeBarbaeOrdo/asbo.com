<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\WhosWhoBundle\Calculator;

use Asbo\Bundle\WhosWhoBundle\Entity\Fra;

/**
 * Interface for object that is calculator for fra
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
interface CalculatorInterface
{
    public function calculate(Fra $fra);
}
