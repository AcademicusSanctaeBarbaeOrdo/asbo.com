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

use Doctrine\Common\Inflector\Inflector;
use Doctrine\ORM\QueryBuilder;

/**
 * Entity Repository
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class ResourceRepository extends EntityRepository
{
    /**
     * {@inheritdoc}
     */
    protected function getQueryBuilder()
    {
        $queryBuilder = parent::getQueryBuilder()
            ->leftJoin($this->getPropertyName('fra'), 'fra')
                ->addSelect('fra')
            ->leftJoin('fra.fraHasUsers', 'fraHasUser')
                ->addSelect('fraHasUser')
            ->leftJoin('fraHasUser.user', 'user')
                ->addSelect('user')
            ->leftJoin('fra.settings', 'settings')
                ->addSelect('settings')
            ->leftJoin('fra.principalImage', 'principalImage')
                ->addSelect('principalImage')
        ;

        $resourcePluralName = Inflector::pluralize($this->getAlias());

        $queryBuilder
            ->leftJoin('fra.'.$resourcePluralName, $resourcePluralName)
                ->addSelect($resourcePluralName)
        ;

        return $queryBuilder;
    }

    /**
     * {@inheritdoc}
     */
    protected function getAlias()
    {
        return lcfirst(substr(strrchr($this->getClassName(), '\\'), 1));
    }
}
