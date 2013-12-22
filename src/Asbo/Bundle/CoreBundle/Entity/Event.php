<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Asbo\Bundle\EventBundle\Model\Event as BaseEvent;
use Asbo\Bundle\EventBundle\Model\EventInterface;

/**
 * Asbo core event entity.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 *
 * @ORM\Table(name="asbo__event_event")
 * @ORM\Entity()
 */
class Event extends BaseEvent implements EventInterface
{
    /**
     * EventHasFras.
     *
     * @var EventHasFra[]
     *
     * @ORM\OneToMany(targetEntity="Asbo\Bundle\CoreBundle\Entity\EventHasFra", mappedBy="event", cascade={"all"}, orphanRemoval=true)
     */
    protected $eventHasFras;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->status = self::STATUS_CONFIRMED;
        $this->eventHasFras = new ArrayCollection();
    }

    /**
     * Get eventHasFras associated to the event.
     *
     * @return EventHasFra[]
     */
    public function getEventHasFras()
    {
        return $this->eventHasFras;
    }

    /**
     * Set eventHasFras associated to the event.
     *
     * @param array $eventHasFras
     *
     * @return self
     */
    public function setEventHasFras(array $eventHasFras = array())
    {
        $this->eventHasFras = new ArrayCollection();

        foreach ($eventHasFras as $eventHasFra) {
            $this->addEventHasFra($eventHasFra);
        }

        return $this;
    }

    /**
     * Verify if events have eventHasFra.
     *
     * @return Boolean
     */
    public function hasEventHasFras()
    {
        return !$this->eventHasFras->isEmpty();
    }

    /**
     * Verify if an eventHasFra already exists.
     *
     * @param EventHasFra $eventHasFra
     *
     * @return Boolean
     */
    public function hasEventHasFra(EventHasFra $eventHasFra)
    {
        return $this->eventHasFras->contains($eventHasFra);
    }

    /**
     * Add an eventHasFra to the event.
     *
     * @param EventHasFra $eventHasFra
     *
     * @return self
     */
    public function addEventHasFra(EventHasFra $eventHasFra)
    {
        if (!$this->hasEventHasFra($eventHasFra)) {
            $eventHasFra->setEvent($this);
            $this->eventHasFras->add($eventHasFra);
        }

        return $this;
    }

    /**
     * Remove an eventHasFra to the event.
     *
     * @param EventHasFra $eventHasFra
     *
     * @return self
     */
    public function removeEventHasFra(EventHasFra $eventHasFra)
    {
        $this->eventHasFras->removeElement($eventHasFra);

        return $this;
    }
}
