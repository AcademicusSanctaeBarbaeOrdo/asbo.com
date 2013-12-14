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

use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Doctrine\ORM\Query;

/**
 * Fra Entity Repository
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 *
 * @method \Asbo\Bundle\WhosWhoBundle\Entity\Fra[] findAll()
 */
class FraRepository extends EntityRepository
{
    /**
     * Find fra with all sub information
     *
     * @param array $criteria
     *
     * @return \Asbo\Bundle\WhosWhoBundle\Entity\Fra|null
     */
    public function findOneWithAllInformation(array $criteria)
    {
        $queryBuilder = $this->getFraQueryBuilderWithAllInformation();

        $this->applyCriteria($queryBuilder, $criteria);

        return $queryBuilder
                ->getQuery(Query::HYDRATE_ARRAY)
                ->setHint(Query::HINT_FORCE_PARTIAL_LOAD, true)
                ->getOneOrNullResult()
            ;
    }

    /**
     * Create filter paginator.
     *
     * @param array $criteria
     * @param array $sorting
     *
     * @return \Asbo\Bundle\WhosWhoBundle\Entity\Fra[]
     */
    public function createFilterPaginator($criteria = array(), $sorting = array())
    {
        $queryBuilder = parent::getCollectionQueryBuilder();

        if (empty($sorting)) {
            if (!is_array($sorting)) {
                $sorting = array();
            }
            $sorting['id'] = 'ASC';
        }

        $this->applyCriteria($queryBuilder, $criteria);
        $this->applySorting($queryBuilder, $sorting);

        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * Finds the next birthday in an interval of days
     *
     * @param integer $interval In day
     *
     * @return \Asbo\Bundle\WhosWhoBundle\Entity\Fra[] An array of Fras
     */
    public function findNextBirthdayInAnIntervalOf($interval = 7)
    {
        $rsm = new ResultSetMappingBuilder($this->getEntityManager());
        $rsm->addRootEntityFromClassMetadata($this->getClassName(), 'fra');

        $sql = "
            SELECT *
            FROM ww__fra fra
            WHERE
                DATE_FORMAT(fra.birthday, '%m-%d')
                    BETWEEN
                        DATE_FORMAT(NOW(), '%m-%d')
                    AND
                        DATE_FORMAT(adddate(now(), interval ".(int) $interval." day), '%m-%d')
            ORDER BY DAY(fra.birthday)
            ;";

        $query = $this->getEntityManager()->createNativeQuery($sql, $rsm);

        return $query->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findLastLogin($amount = 10)
    {
        $queryBuilder = $this->getQueryBuilder();

        return $queryBuilder
            ->andWhere('fraHasUser.owner = :owner')
                ->setParameter('owner', true)
            ->setMaxResults($amount)
            ->orderBy('user.lastLogin', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * Add all sub information to fra query builder.
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    protected function getFraQueryBuilderWithAllInformation()
    {

        $queryBuilder = $this->getQueryBuilder();

        $queryBuilder
            ->leftJoin('fra.fraHasPosts', 'fraHasPost')
                ->addSelect('fraHasPost')
            ->leftJoin('fra.addresses', 'address')
                ->addSelect('address')
            ->leftJoin('fra.diplomas', 'diploma')
                ->addSelect('diploma')
            ->leftJoin('fra.emails', 'email')
                ->addSelect('email')
            ->leftJoin('fra.externalPosts', 'externalPost')
                ->addSelect('externalPost')
            ->leftJoin('fra.families', 'family')
                ->addSelect('family')
            ->leftJoin('fra.jobs', 'job')
                ->addSelect('job')
            ->leftJoin('fra.phones', 'phone')
                ->addSelect('phone')
            ->leftJoin('fra.ranks', 'rank')
                ->addSelect('rank')
            ->leftJoin('fraHasPost.post', 'post')
                ->addSelect('post')
        ;

        return $queryBuilder;
    }

    /**
     * {@inheritdoc}
     */
    protected function getQueryBuilder()
    {
        $queryBuilder = parent::getQueryBuilder()
            ->leftJoin('fra.fraHasUsers', 'fraHasUser')
                ->addSelect('fraHasUser')
            ->leftJoin('fraHasUser.user', 'user')
                ->addSelect('user')
            ->leftJoin('fra.principalAddress', 'principalAddress')
                ->addSelect('principalAddress')
            ->leftJoin('fra.principalEmail', 'principalEmail')
                ->addSelect('principalEmail')
            ->leftJoin('fra.principalPhone', 'principalPhone')
                ->addSelect('principalPhone')
            ->leftJoin('fra.principalImage', 'principalImage')
                ->addSelect('principalImage')
            ->leftJoin('fra.settings', 'settings')
                ->addSelect('settings')
        ;

        return $queryBuilder;
    }

    /**
     * {@inheritdoc}
     */
    protected function getCollectionQueryBuilder()
    {
        return $this->getQueryBuilder();
    }

    /**
     * {@inheritdoc}
     */
    protected function getAlias()
    {
        return 'fra';
    }
}
