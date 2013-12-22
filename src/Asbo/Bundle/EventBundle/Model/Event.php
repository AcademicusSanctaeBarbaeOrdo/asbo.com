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

use InvalidArgumentException;

/**
 * Event model.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class Event implements EventInterface
{
    /**
     * Id
     *
     * @var integer
     */
    protected $id;

    /**
     * Name of event.
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
     * Start date of event.
     *
     * @var \DateTime
     */
    protected $startsAt;

    /**
     * End date of event.
     *
     * @var \DateTime
     */
    protected $endsAt;

    /**
     * The calendar associated with this event.
     *
     * @var CalendarInterface
     */
    protected $calendar;

    /**
     * The location of event.
     *
     * @var string
     */
    protected $location;

    /**
     * The status of event.
     *
     * @var string
     */
    protected $status;

    /**
     * Last time updated
     *
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * Creation date
     *
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * {@inheritdoc}
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getStartsAt()
    {
        return $this->startsAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setStartsAt(\DateTime $startsAt = null)
    {
        $this->startsAt = $startsAt;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getEndsAt()
    {
        return $this->endsAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setEndsAt(\DateTime $endsAt = null)
    {
        $this->endsAt = $endsAt;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCalendar()
    {
        return $this->calendar;
    }

    /**
     * {@inheritdoc}
     */
    public function setCalendar(CalendarInterface $calendar = null)
    {
        $this->calendar = $calendar;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * {@inheritdoc}
     */
    public function setLocation($location = null)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * {@inheritdoc}
     */
    public function setStatus($status = null)
    {
        if (null !== $status && !in_array($status, self::getStatuses())) {
            throw new InvalidArgumentException(sprintf('Wrong event status supplied: "%s" given.', $status));
        }

        $this->status = $status;

        return $this;
    }

    /**
     * Returns all event statuses available.
     *
     * @return array of self::STATUS_*
     */
    public static function getStatuses()
    {
        return array_keys(self::getStatusChoices());
    }

    /**
     * Used in form choice field.
     *
     * @return array
     */
    public static function getStatusChoices()
    {
        return array(
            self::STATUS_CANCELLED => 'Cancelled',
            self::STATUS_CONFIRMED => 'Confirmed',
            self::STATUS_TENTATIVE => 'Tentative',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->name ?: '';
    }
}
