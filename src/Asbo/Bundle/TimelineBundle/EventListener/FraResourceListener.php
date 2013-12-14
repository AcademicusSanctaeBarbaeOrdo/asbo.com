<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\TimelineBundle\EventListener;

use Asbo\Bundle\CoreBundle\Twig\GlobalVariables;
use Asbo\Bundle\WhosWhoBundle\Entity\Fra;
use Asbo\Bundle\WhosWhoBundle\Model\FraResourceInterface;
use Spy\Timeline\Driver\ActionManagerInterface;
use Spy\Timeline\Model\ComponentInterface;
use Sylius\Bundle\ResourceBundle\Event\ResourceEvent;

class FraResourceListener
{
    /**
     * Action manager.
     *
     * @var ActionManagerInterface
     */
    private $actionManager;

    /**
     * Fra manipulator.
     *
     * @var \Asbo\Bundle\CoreBundle\Twig\GlobalVariables
     */
    private $asbo;

    /**
     * The namespace of resource.
     *
     * @var string
     */
    private $resource;

    /**
     * Constructor.
     *
     * @param ActionManagerInterface $actionManager
     * @param GlobalVariables        $asbo
     * @param $resource
     */
    public function __construct(ActionManagerInterface $actionManager, GlobalVariables $asbo, $resource)
    {
        $this->actionManager = $actionManager;
        $this->asbo = $asbo;
        $this->resource = $resource;
    }

    protected function upgrade(FraResourceInterface $resource, $verb)
    {
        $fra = $this->asbo->getFra();

        if (!$this->support($resource, $fra)) {
            return;
        }

        $subject = $this->getSubject($fra);

        $this->create($subject, sprintf($verb, $this->resource),
            [
                'target' => $this->getTarget($resource),
                'target_text' => (string) $resource,
            ]
        );
    }

    /**
     * @param ResourceEvent $event
     */
    public function addResource(ResourceEvent $event)
    {
        $this->upgrade($event->getSubject(), 'asbo_whoswho.%s.create');
    }

    public function updateResource(ResourceEvent $event)
    {
        $this->upgrade($event->getSubject(), 'asbo_whoswho.%s.update');
    }

    public function removeResource(ResourceEvent $event)
    {
        $this->upgrade($event->getSubject(), 'asbo_whoswho.%s.delete');
    }

    public function updatePrincipalResource(ResourceEvent $event)
    {
        $this->upgrade($event->getSubject()->{'getPrincipal'.ucfirst($this->resource)}(), 'asbo_whoswho.%s.principal_update');
    }

    protected function getSubject($fra)
    {
        return $this->actionManager->findOrCreateComponent($fra);
    }

    protected function create(ComponentInterface $subject, $verb, $components = array())
    {
        $action = $this->actionManager->create($subject, $verb, $components);

        $this->actionManager->updateAction($action);
    }

    protected function getTarget(FraResourceInterface $resource)
    {
        return $this->actionManager->findOrCreateComponent($resource);
    }

    private function support(FraResourceInterface $resource, Fra $fra = null)
    {
        if (!$fra instanceof \Asbo\Bundle\WhosWhoBundle\Entity\Fra) {
            return false;
        }

        if ($fra->getId() !== $resource->getFra()->getId()) {
            return false;
        }

        return true;
    }
}
