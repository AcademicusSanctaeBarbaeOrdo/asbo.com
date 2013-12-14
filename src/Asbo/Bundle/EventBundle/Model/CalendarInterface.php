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

/**
 * Calendar model interface.
 * All driver calendar entities or documents should implement this interface.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
interface CalendarInterface
{
    /**
     * Get the name of calendar.
     *
     * @return string
     */
    public function getName();

    /**
     * Set the name of calendar.
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name);

    /**
     * Get description of event.
     *
     * @return string
     */
    public function getDescription();

    /**
     * Set description of event.
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription($description);

    /**
     * Verify if calendar have events.
     *
     * @return Boolean
     */
    public function hasEvents();

    /**
     * Get events associated to the calendar.
     *
     * @return EventInterface
     */
    public function getEvents();

    /**
     * Verify if an event already exists.
     *
     * @param EventInterface $event
     *
     * @return Boolean
     */
    public function hasEvent(EventInterface $event);

    /**
     * Add an event to the calendar.
     *
     * @param EventInterface $event
     *
     * @return self
     */
    public function addEvent(EventInterface $event);

    /**
     * Remove an event to the calendar.
     *
     * @param EventInterface $event
     *
     * @return self
     */
    public function removeEvent(EventInterface $event);

    /**
     * Set a sets of events to the calendar.
     *
     * @param EventInterface[] $events
     *
     * @return self
     */
    public function setEvents(array $events = array());

    /**
     * Convert the entity into array
     *
     * @return array
     */
    public function toArray();
}
