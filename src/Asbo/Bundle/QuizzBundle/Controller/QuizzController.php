<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\QuizzBundle\Controller;

use Asbo\Bundle\WhosWhoBundle\Entity\Fra;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;

/**
 * Controller of quizz page
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class QuizzController extends ResourceController
{
    /**
     * Get all quizzes by a single fra
     *
     * @param Fra $fra
     */
    public function getQuizzesByFraAction(Fra $fra)
    {
        $quizzes = $this->getQuizzAnnoHasFraRepository()->findBy(['fra' => $fra]);

        return $this->renderResponse(
            'list.html',
            [
                'quizzes' => $quizzes
            ]
        );
    }

    /**
     * Get last quizz with all fra
     */
    public function getLastQuizzAction()
    {
        $quizz = $this->getQuizzAnnoRepository()->findLastQuizzByAnnoAndType();

        return $this->renderResponse(
            'last.html',
            [
                'quizz' => $quizz
            ]
        );
    }

    /**
     * @return \Asbo\Bundle\QuizzBundle\Doctrine\QuizzAnnoHasFraRepository
     */
    protected function getQuizzAnnoHasFraRepository()
    {
        return $this->get('asbo_quizz.repository.quizz_anno_has_fra');
    }

    /**
     * @return \Asbo\Bundle\QuizzBundle\Doctrine\QuizzAnnoRepository
     */
    protected function getQuizzAnnoRepository()
    {
        return $this->get('asbo_quizz.repository.quizz_anno');
    }
}
