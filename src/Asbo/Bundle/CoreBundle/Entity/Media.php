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

use Asbo\Bundle\WhosWhoBundle\Model\FraImageInterface;
use Sonata\MediaBundle\Entity\BaseMedia as BaseMedia;

/**
 * Represent a Media entity.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class Media extends BaseMedia implements FraImageInterface
{
    /**
     * @var integer $id
     */
    protected $id;

    /**
     * Get id.
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }
}
