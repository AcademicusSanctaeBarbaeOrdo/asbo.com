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

/**
 * Represent a Job entity.
 *
 * @ORM\Table(name="ww__job")
 * @ORM\Entity(repositoryClass="Asbo\Bundle\WhosWhoBundle\Doctrine\ResourceRepository")
 */
class Job implements FraResourceInterface
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
     * @var Fra
     *
     * @ORM\ManyToOne(targetEntity="Asbo\Bundle\WhosWhoBundle\Entity\Fra", inversedBy="jobs", fetch="EAGER")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $fra;

    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=100, nullable=false)
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $company;

    /**
     * @var string
     *
     * @ORM\Column(name="sector", type="string", length=50, nullable=true)
     */
    private $sector;

    /**
     * @var string
     *
     * @ORM\Column(name="position", type="string", length=150, nullable=false)
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $position;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateBegin", type="date", nullable=true)
     * @Assert\Date()
     * @Assert\NotNull()
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
     * Get id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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
     * Set company.
     *
     * @param string $company
     *
     * @return self
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company.
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set sector.
     *
     * @param string $sector
     *
     * @return self
     */
    public function setSector($sector)
    {
        $this->sector = $sector;

        return $this;
    }

    /**
     * Get sector.
     *
     * @return string
     */
    public function getSector()
    {
        return $this->sector;
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
     * Set dateBegin.
     *
     * @param \DateTime $dateBegin
     *
     * @return self
     */
    public function setDateBegin($dateBegin)
    {
        $this->dateBegin = $dateBegin;

        return $this;
    }

    /**
     * Get dateBegin.
     *
     * @return \DateTime
     */
    public function getDateBegin()
    {
        return $this->dateBegin;
    }

    /**
     * Set dateEnd.
     *
     * @param \DateTime $dateEnd
     *
     * @return self
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd.
     *
     * @return \DateTime
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Is a current job ?
     *
     * @return boolean
     */
    public function isCurrent()
    {
        return (null === $this->dateEnd);
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

    /**
     * Auto-render on toString.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getPosition() . ' in ' . $this->getCompany();
    }
}
