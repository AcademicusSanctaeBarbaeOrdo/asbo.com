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

use Sonata\MediaBundle\Entity\BaseGalleryHasMedia as BaseGalleryHasMedia;

/**
 * Represent a GalleryHasMedia entity.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class GalleryHasMedia extends BaseGalleryHasMedia
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
