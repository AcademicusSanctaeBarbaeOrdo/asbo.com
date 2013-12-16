<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\TimelineBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Timeline controller.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class TimelineController extends FOSRestController
{
    /**
     * Return a timeline of current Fra.
     */
    public function timelineAction(Request $request)
    {
        $fra = $this
            ->getFraController()
            ->findOr404()
        ;

        $subject = $this->getActionManager()->findOrCreateComponent($fra);
        $timeline = $this->getTimelineManager()->getTimeline($subject);
        $config = $this->getFraController()->getConfiguration();

        $view = $this
            ->view()
            ->setTemplate($config->getTemplate('timeline.html'))
            ->setData(
                [
                    $config->getResourceName() => $fra,
                    'timeline' => $timeline
                ]
            )
        ;

        return $this->handleView($view);
    }

    /**
     * @return \Asbo\Bundle\WhosWhoBundle\Controller\FraController
     */
    protected function getFraController()
    {
        return $this->get('asbo_whoswho.controller.fra');
    }

    /**
     * @return \Spy\Timeline\Driver\ActionManagerInterface
     */
    protected function getActionManager()
    {
        return $this->get('spy_timeline.action_manager');
    }

    /**
     * @return \Spy\Timeline\Driver\TimelineManagerInterface
     */
    protected function getTimelineManager()
    {
        return $this->get('spy_timeline.timeline_manager');
    }
}
