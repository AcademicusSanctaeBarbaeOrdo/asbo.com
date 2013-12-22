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

use Asbo\Bundle\WhosWhoBundle\Entity\Fra;
use Asbo\Bundle\EventBundle\Model\EventInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Asbo core eventHasFra entity.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 *
 * @ORM\Table(name="asbo__event_event_has_fra")
 * @ORM\Entity()
 */
class EventHasFra
{
    const STATUS_JOIN = 'join';
    const STATUS_MAYBE = 'maybe';
    const STATUS_DECLINE = 'decline';
    const STATUS_NOT_RESPONDED = 'not responded';

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Event
     *
     * @var EventInterface
     *
     * @ORM\ManyToOne(targetEntity="Asbo\Bundle\CoreBundle\Entity\Event", inversedBy="eventHasFras", fetch="EAGER")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    protected $event;

    /**
     * Fra
     *
     * @var Fra
     *
     * @ORM\ManyToOne(targetEntity="Asbo\Bundle\WhosWhoBundle\Entity\Fra", fetch="EAGER")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    protected $fra;

    /**
     * Status
     *
     * @var string $status
     *
     * @ORM\Column(name="status", type="string", length=10)
     * @Assert\Choice(callback = {"Asbo\Bundle\CoreBundle\Entity\EventHasFra", "getCallbackValidation"})
     */
    protected $status;

    /**
     * Get id.
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the associated event to eventHasFra.
     *
     * @param EventInterface $event
     *
     * @return self
     */
    public function setEvent(EventInterface $event)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get the event associated to eventHasFra.
     *
     * @return EventInterface
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set the associated fra to eventHasFra.
     *
     * @param Fra $fra
     *
     * @return self
     */
    public function setFra(Fra $fra)
    {
        $this->fra = $fra;

        return $this;
    }

    /**
     * Get the fra associated to eventHasFra.
     *
     * @return Fra
     */
    public function getFra()
    {
        return $this->fra;
    }

    /**
     * Set status.
     *
     * @param  string                    $status
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get The status choices.
     *
     * @return array
     */
    public static function getStatusChoices()
    {
        return [
            self::STATUS_JOIN => 'Participer',
            self::STATUS_MAYBE => 'Peut-être...',
            self::STATUS_DECLINE => 'Décliner',
        ];
    }

    /**
     * Returns an array with authorized keys.
     *
     * @return array The authorized keys.
     */
    final public static function getCallbackValidation()
    {
        return array_keys(static::getStatusChoices());
    }

    /**
     * {@inhertiDoc}
     */
    public function __toString()
    {
        return (string) $this->fra;
    }
}
