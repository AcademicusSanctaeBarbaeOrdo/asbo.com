<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\CoreBundle\Entity;

use Sonata\UserBundle\Entity\BaseGroup as BaseGroup;

/**
 * Represent a Group entity.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class Group extends BaseGroup
{
    /**
     * @var integer $id
     */
     protected $id;
}
