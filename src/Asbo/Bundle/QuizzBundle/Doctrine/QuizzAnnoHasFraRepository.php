<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\QuizzBundle\Doctrine;

/**
 * QuizzAnnoHasFra Repository
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class QuizzAnnoHasFraRepository extends EntityRepository
{
    /**
     * {@inheritdoc}
     */
    protected function getQueryBuilder()
    {
        $queryBuilder = parent::getQueryBuilder()
            ->leftJoin('quizzHasFra.fra', 'fra')
                ->addSelect('fra')
            ->leftJoin('quizzHasFra.quizzAnno', 'quizzAnno')
                ->addSelect('quizzAnno')
            ->leftJoin('quizzAnno.quizz', 'quizz')
                ->addSelect('quizz')
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
        return 'quizzHasFra';
    }
}
