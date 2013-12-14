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
 * Event model interface.
 * All driver event entities or documents should implement this interface.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
interface EventInterface
{
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_TENTATIVE = 'tentative';
    const STATUS_CANCELLED = 'cancelled';

    /**
     * Get name of event.
     *
     * @return string
     */
    public function getName();

    /**
     * Set name of event.
     *
     * @param $name
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
     * Get start date of event.
     *
     * @return \DateTime
     */
    public function getStartsAt();

    /**
     * Set start date of event.
     *
     * @param \DateTime $startsAt
     *
     * @return self
     */
    public function setStartsAt(\DateTime $startsAt = null);

    /**
     * Get end date of event.
     *
     * @return \DateTime
     */
    public function getEndsAt();

    /**
     * Set end date of event.
     *
     * @param \DateTime $endsAt
     *
     * @return self
     */
    public function setEndsAt(\DateTime $endsAt = null);

    /**
     * Get the calendar associated with this event.
     *
     * @return CalendarInterface
     */
    public function getCalendar();

    /**
     * Set the calendar associated with this event.
     *
     * @param CalendarInterface $calendar
     *
     * @return self
     */
    public function setCalendar(CalendarInterface $calendar = null);

    /**
     * Get the locaion of event.
     *
     * @return string
     */
    public function getLocation();

    /**
     * Set the location of event.
     *
     * @param string $location
     *
     * @return self
     */
    public function setLocation($location = null);

    /**
     * Get the status of event.
     *
     * @return string
     */
    public function getStatus();

    /**
     * Set the status of event.
     *
     * @param string|null $status
     *
     * @return self
     */
    public function setStatus($status = null);
}
