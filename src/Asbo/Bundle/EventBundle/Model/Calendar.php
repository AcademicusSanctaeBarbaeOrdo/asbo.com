<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\EventBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Calendar model.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class Calendar implements CalendarInterface
{
    /**
     * Id
     *
     * @var integer
     */
    protected $id;

    /**
     * The name of calendar.
     *
     * @var string
     */
    protected $name;

    /**
     * Description of event.
     *
     * @var string
     */
    protected $description;

    /**
     * The events associated to the calendar.
     *
     * @var EventInterface[]
     */
    protected $events;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->events = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inhertiDoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inhertiDoc}
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * {@inhertiDoc}
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * {@inhertiDoc}
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function hasEvents()
    {
        return !$this->events->isEmpty();

    }

    /**
     * {@inhertiDoc}
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * {@inhertiDoc}
     */
    public function hasEvent(EventInterface $event)
    {
        return $this->events->contains($event);
    }

    /**
     * {@inheritdoc}
     */
    public function addEvent(EventInterface $event)
    {
        if (!$this->hasEvent($event)) {
            $event->setCalendar($this);
            $this->events->add($event);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeEvent(EventInterface $event)
    {
        $event->setCalendar(null);
        $this->events->removeElement($event);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->name ?: '';
    }

    /**
     * {@inheritdoc}
     */
    public function setEvents(array $events = array())
    {
        $this->events = new ArrayCollection();

        foreach ($events as $event) {
            $this->addEvent($event);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        $toArray =  array(
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'events' => array()
        );

        foreach ($this->getEvents() as $event) {
            $toArray['events'][] = $event;
        }

        return $toArray;
    }
}
