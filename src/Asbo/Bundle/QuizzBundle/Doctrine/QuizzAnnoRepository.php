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

use Asbo\Bundle\QuizzBundle\Model\QuizzTypes;
use Asbo\Bundle\WhosWhoBundle\Util\AnnoManipulator;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * Entity Repository
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class QuizzAnnoRepository extends EntityRepository
{
    /**
     * Find the last quizz
     */
    public function findLastQuizzByAnnoAndType($anno = null, $type = QuizzTypes::REQUIRED)
    {
        if (null === $anno) {
            $anno = AnnoManipulator::getCurrentAnno();
        }

        $qb = $this
            ->getQueryBuilder()
            ->where('quizzAnno.anno = :anno')
            ->setParameter('anno', $anno)
            ->andWhere('quizz.type = :type')
            ->setParameter('type', $type)
            ->orderBy('quizzAnno.date', 'DESC')
            ->setMaxResults(1)
        ;

        /*
         * Quick and dirty !
         *
         * On fait une jointure et on demande de récupérer le dernier élément.
         * Or il y a plus que un élément puisqu'on "joint" les données.
         * @see http://docs.doctrine-project.org/en/latest/tutorials/pagination.html
         */

        $iterator = (new Paginator($qb->getQuery(), true))->getIterator();

        if (0 === count($iterator)) {
            return null;
        }

        return $iterator[0];

    }

    /**
     * {@inheritdoc}
     */
    protected function getQueryBuilder()
    {
        $queryBuilder = parent::getQueryBuilder()
            // On veut qu'il y ai des tyros qui aient déjà passé l'interro
            ->join('quizzAnno.quizzAnnoHasFras', 'fras')
            ->addSelect('fras')
            ->join('quizzAnno.quizz', 'quizz')
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
        return 'quizzAnno';
    }
}
