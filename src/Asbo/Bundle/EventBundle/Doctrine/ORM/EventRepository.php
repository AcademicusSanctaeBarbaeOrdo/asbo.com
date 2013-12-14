<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\EventBundle\Doctrine\ORM;

use Asbo\Bundle\EventBundle\Model\EventInterface;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Asbo\Bundle\EventBundle\Repository\EventRepositoryInterface;

/**
 * Order repository.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class EventRepository extends EntityRepository implements EventRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findUpcomingConfirmedEvents($amount = 10)
    {
        return $this->findEventsByStatusQueryBuilder(
            $amount,
            EventInterface::STATUS_CONFIRMED,
            ['startsAt' => 'ASC'],
            true
        )->getQuery()->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findPastConfirmedEvents($amount = 5)
    {
        return $this->findEventsByStatusQueryBuilder(
            $amount,
            EventInterface::STATUS_CONFIRMED,
            ['startsAt' => 'DESC'],
            false
        )->getQuery()->getResult();
    }

    public function findNextUpcomingConfirmedEvent()
    {
        $qb = $this->findEventsByStatusQueryBuilder(1, EventInterface::STATUS_CONFIRMED, ['startsAt' => 'ASC'], true);

        return $qb->getQuery()->getOneOrNullResult();
    }

    protected function findEventsByStatusQueryBuilder($amount = 5, $status = EventInterface::STATUS_CONFIRMED, $orderBy = array(), $upcoming = true, $inclusive = true)
    {
        $queryBuilder = $this
            ->getQueryBuilder()
            ->andWhere(
                sprintf(
                    '%s.status = :status',
                    $this->getAlias()
                )
            )
            ->andWhere(
                sprintf(
                    '%s.startsAt %s :date',
                    $this->getAlias(),
                    $this->getOperator($upcoming, $inclusive)
                )
            )
            ->setParameter('date', new \DateTime('now'))
            ->setParameter('status', $status)
            ->setMaxResults($amount)
        ;

        $this->applySorting($queryBuilder, $orderBy);

        return $queryBuilder;
    }

    /**
     * {@inheritdoc}
     */
    protected function getQueryBuilder()
    {
        return parent::getQueryBuilder()
            ->leftJoin($this->getAlias().'.calendar', 'calendar')
            ->addSelect('calendar')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function getAlias()
    {
        return 'e';
    }

    /**
     * Returns operator based on params.
     *
     * @param $up boolean
     * @param $inclusive boolean
     *
     * @return string The operator.
     */
    private function getOperator($up, $inclusive)
    {
        $operator = '>';

        if (false === $up) {
            $operator = '<';
        }

        if (true === $inclusive) {
            $operator .= '=';
        }

        return $operator;
    }
}
