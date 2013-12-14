<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\WhosWhoBundle\Entity;

use Asbo\Bundle\WhosWhoBundle\Model\FraResourceInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use DateTime;

/**
 * Represent an ExternalPost entity.
 *
 * @ORM\Table(name="ww__externalPost")
 * @ORM\Entity(repositoryClass="Asbo\Bundle\WhosWhoBundle\Doctrine\ResourceRepository")
 */
class ExternalPost implements FraResourceInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=100, nullable=false)
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $where;

    /**
     * @var string
     *
     * @ORM\Column(name="position", type="string", length=50, nullable=false)
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $position;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateBegin", type="date")
     * @Assert\Date()
     */
    private $dateBegin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEnd", type="date", nullable=true)
     * @Assert\Date()
     */
    private $dateEnd;

    /**
     * Asbo\Bundle\WhosWhoBundle\Entity\Fra $fra
     *
     * @ORM\ManyToOne(targetEntity="Asbo\Bundle\WhosWhoBundle\Entity\Fra", inversedBy="externalPosts", fetch="EAGER")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $fra;

    /**
     * Get id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set where.
     *
     * @param string $where
     *
     * @return self
     */
    public function setWhere($where)
    {
        $this->where = $where;

        return $this;
    }

    /**
     * Get where.
     *
     * @return string
     */
    public function getWhere()
    {
        return $this->where;
    }

    /**
     * Set position.
     *
     * @param string $position
     *
     * @return self
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position.
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set date begin of post.
     *
     * @param \DateTime $dateBegin
     *
     * @return self
     */
    public function setDateBegin($dateBegin = null)
    {
        $this->dateBegin = $dateBegin;

        return $this;
    }

    /**
     * Get the begin date of post.
     *
     * @return \DateTime
     */
    public function getDateBegin()
    {
        return $this->dateBegin;
    }

    /**
     * Set end date of post.
     *
     * @param \DateTime $dateEnd
     *
     * @return self
     */
    public function setDateEnd($dateEnd = null)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Get end date of post.
     *
     * @return \DateTime
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Set fra.
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
     * Get fra.
     *
     * @return Fra
     */
    public function getFra()
    {
        return $this->fra;
    }

    /**
     * Is a current external post ?
     *
     * @return boolean
     */
    public function isCurrent()
    {
        return (null === $this->dateEnd);
    }

    /**
     * Auto-render on toString.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getPosition() . ' in ' . $this->getWhere();
    }

    /**
     * See if the begin date is less than the end date.
     *
     * @Assert\True(message = "La date de départ doit être inférieur ou égale à la date d'arrivée")
     */
    public function isDateBeginLessThanDateEnd()
    {
        return ($this->dateBegin <= $this->dateEnd || $this->isCurrent());
    }
}
