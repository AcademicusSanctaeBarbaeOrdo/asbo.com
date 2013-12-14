<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\WhosWhoBundle\Model;

use Asbo\Bundle\WhosWhoBundle\Entity\Fra;

/**
 * Class FraResourceInterface
 */
interface FraResourceInterface
{
    /**
     * @return mixed The id of Resource
     */
    public function getId();

    /**
     * Set fra
     *
     * @param  Fra  $fra
     * @return self
     */
    public function setFra(Fra $fra);

    /**
     * Returns the linked fra.
     *
     * @return Fra The Fra instance.
     */
    public function getFra();
}
