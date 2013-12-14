<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\WebBundle\Controller\Frontend;

use Asbo\Bundle\QuizzBundle\Model\QuizzTypes;
use Asbo\Bundle\WhosWhoBundle\Util\AnnoManipulator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Frontend homepage controller.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class HomepageController extends Controller
{
    /**
     * Frontend homepage display action.
     */
    public function mainAction()
    {
        $quizzByAnnoRepository = $this->getQuizzByAnnoRepository();
        $fraRepository = $this->getFraRepository();
        $eventRepository = $this->getEventRepository();

        return $this->render('AsboWebBundle:Frontend/Homepage:main.html.twig', [
                'next_fras_birthdays' => $fraRepository->findNextBirthdayInAnIntervalOf(7),
                'last_fras_login' => $fraRepository->findLastLogin(10),
                'next_event' => $eventRepository->findNextUpcomingConfirmedEvent(),
                'next_events' => $eventRepository->findUpcomingConfirmedEvents(5),
                'last_quizz' => $quizzByAnnoRepository->findLastQuizzByAnnoAndType(AnnoManipulator::getCurrentAnno(), QuizzTypes::REQUIRED),
            ]
        );
    }

    /**
     * @return \Asbo\Bundle\QuizzBundle\Doctrine\QuizzAnnoRepository
     */
    protected function getQuizzByAnnoRepository()
    {
        return $this->get('asbo_quizz.repository.quizz_anno');
    }

    /**
     * @return \Asbo\Bundle\WhosWhoBundle\Doctrine\FraRepository
     */
    protected function getFraRepository()
    {
        return $this->get('asbo_whoswho.repository.fra');
    }

    /**
     * @return \Asbo\Bundle\EventBundle\Doctrine\ORM\EventRepository
     */
    protected function getEventRepository()
    {
        return $this->get('asbo.repository.event');
    }
}
