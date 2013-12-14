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

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Asbo\Bundle\WhosWhoBundle\Entity\Fra;
use Asbo\Bundle\WhosWhoBundle\Model\FraResourceInterface;

/**
 * Represent a Diploma Entity.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 *
 * @ORM\Table(name="ww__diploma")
 * @ORM\Entity(repositoryClass="Asbo\Bundle\WhosWhoBundle\Doctrine\ResourceRepository")
 */
class Diploma implements FraResourceInterface
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
     * @ORM\Column(name="name", type="string", length=50)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="specialty", type="string", length=50, nullable=true)
     */
    private $specialty;

    /**
     * @var string
     *
     * @ORM\Column(name="institution", type="string", length=50)
     * @Assert\NotBlank()
     */
    private $institution;

    /**
     * @var \Datetime
     *
     * @ORM\Column(name="graduatedAt", type="date", nullable=true)
     */
    private $graduatedAt;

    /**
     * @var Fra
     *
     * @ORM\ManyToOne(targetEntity="Asbo\Bundle\WhosWhoBundle\Entity\Fra", inversedBy="diplomas", fetch="EAGER")
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
     * Set name.
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set specialty.
     *
     * @param string $specialty
     *
     * @return self
     */
    public function setSpecialty($specialty)
    {
        $this->specialty = $specialty;

        return $this;
    }

    /**
     * Get specialty.
     *
     * @return string
     */
    public function getSpecialty()
    {
        return $this->specialty;
    }

    /**
     * Set institution.
     *
     * @param string $institution
     *
     * @return self
     */
    public function setInstitution($institution)
    {
        $this->institution = $institution;

        return $this;
    }

    /**
     * Get institution.
     *
     * @return string
     */
    public function getInstitution()
    {
        return $this->institution;
    }

    /**
     * Set graduated at.
     *
     * @param \Datetime $graduatedAt
     *
     * @return self
     */
    public function setGraduatedAt($graduatedAt = null)
    {
        $this->graduatedAt = $graduatedAt;

        return $this;
    }

    /**
     * Get graduated at.
     *
     * @return \Datetime
     */
    public function getGraduatedAt()
    {
        return $this->graduatedAt;
    }

    /**
     * Is current diploma ?
     *
     * @return boolean
     */
    public function isCurrent()
    {
        return null === $this->getGraduatedAt();
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
     * Auto-render on toString.
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getName().' @ '.$this->getInstitution();
    }
}
