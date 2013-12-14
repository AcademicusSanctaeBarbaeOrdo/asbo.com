<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\WhosWhoBundle\Doctrine;

use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository as BaseEntityRepository;

/**
 * Entity Repository.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class EntityRepository extends BaseEntityRepository
{
    /**
     * Override because in original file, param of find can be mixed.
     * @see SonataORMAdminBundle
     *
     * @param mixed $id
     *
     * @return mixed|object
     */
    public function find($id)
    {
        if (is_array($id)) {
            return \Doctrine\ORM\EntityRepository::find($id);
        }

        return parent::find($id);
    }
}
