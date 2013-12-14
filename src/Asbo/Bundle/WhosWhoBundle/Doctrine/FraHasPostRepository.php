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

use Doctrine\ORM\QueryBuilder;
use Asbo\Bundle\WhosWhoBundle\Entity\FraHasPost;

/**
 * Entity Repository.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class FraHasPostRepository extends ResourceRepository
{
    /**
     * Returns the fraHasPosts entities by types.
     *
     * @param array      $types
     * @param array|null $orderBy
     * @param int|null   $limit
     * @param int|null   $offset
     *
     * @return FraHasPost[]
     */
    public function findByTypes(array $types, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->getByTypesBuilder($types, $orderBy, $limit, $offset)->getQuery()->getResult();
    }

    /**
     * Returns the FraHasPosts entities by types and anno.
     *
     * @param array      $types
     * @param int        $anno
     * @param array|null $orderBy
     * @param int|null   $limit
     * @param int|null   $offset
     *
     * @return FraHasPost[]
     */
    public function findByTypesAndAnno(array $types, $anno, array $orderBy = null, $limit = null, $offset = null)
    {
        $queryBuilder = $this->getByTypesBuilder($types, $orderBy, $limit, $offset);
        $queryBuilder->andWhere($this->getPropertyName('anno').' = :anno')->setParameter('anno', $anno, \PDO::PARAM_INT);

        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * Returns a builder to find FrahasPost by type.
     *
     * @param array      $types
     * @param array|null $orderBy
     * @param int|null   $limit
     * @param int|null   $offset
     *
     * @return QueryBuilder
     */
    public function getByTypesBuilder(array $types, array $orderBy = null, $limit = null, $offset = null)
    {
        $queryBuilder = $this->getCollectionQueryBuilder();
        $queryBuilder->where($queryBuilder->expr()->in('post.type', $types));

        $this->applySorting($queryBuilder, $orderBy);

        if (null !== $limit) {
            $queryBuilder->setMaxResults($limit);
        }

        if (null !== $offset) {
            $queryBuilder->setFirstResult($offset);
        }

        return $queryBuilder;
    }

    /**
     * {@inheritdoc}
     */
    protected function getCollectionQueryBuilder()
    {
        $queryBuilder = $this->createQueryBuilder($this->getAlias());
        $queryBuilder
            ->leftJoin('fraHasPost.fra', 'fra')
                ->addSelect('fra')
            ->leftJoin('fra.principalImage', 'principalImage')
                ->addSelect('principalImage')
            ->leftJoin('fra.fraHasUsers', 'fraHasUser')
                ->addSelect('fraHasUser')
            ->leftJoin('fraHasUser.user', 'user')
                ->addSelect('user')
            ->leftJoin('fraHasPost.post', 'post')
                ->addSelect('post')
        ;

        return $queryBuilder;
    }
}
