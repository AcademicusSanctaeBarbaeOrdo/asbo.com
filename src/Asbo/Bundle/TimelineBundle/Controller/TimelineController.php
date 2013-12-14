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
    public function timelineAction(Request $request)
    {
        $slug = $request->get('subject');

        $fra = $this
            ->getFraController()
            ->getRepository()
            ->findOneBy(['slug' => $slug]);

        if (!$fra) {
            return $this->createNotFoundException(
                sprintf('The fra with "%s" slug was not found.', $slug)
            );
        }

        $actionManager   = $this->get('spy_timeline.action_manager');
        $timelineManager = $this->get('spy_timeline.timeline_manager');
        $subject         = $actionManager->findOrCreateComponent($fra);
        $timeline        = $timelineManager->getTimeline($subject);

        $view = $this
            ->view()
            ->setTemplate($this->getFraController()->getConfiguration()->getTemplate('timeline.html'))
            ->setData(
                [
                    $this->getFraController()->getConfiguration()->getResourceName() => $fra,
                    'timeline' => $timeline
                ]
            )
        ;

        return $this->handleView($view);
    }

    /**
     * @return \Asbo\Bundle\WhosWhoBundle\Controller\FraController
     */
    public function getFraController()
    {
        return $this->get('asbo_whoswho.controller.fra');
    }
}
