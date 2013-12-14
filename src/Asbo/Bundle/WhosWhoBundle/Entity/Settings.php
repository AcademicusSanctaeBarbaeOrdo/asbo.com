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

/**
 * Represent a Settings Entity.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 *
 * @ORM\Table(name="ww__settings")
 * @ORM\Entity()
 */
class Settings
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
     * @var boolean
     *
     * @ORM\Column(name="whoswho", type="boolean")
     */
    private $whoswho;

    /**
     * @var boolean
     *
     * @ORM\Column(name="pereat", type="boolean")
     */
    private $pereat;

    /**
     * @var boolean
     *
     * @ORM\Column(name="convoc_externe", type="boolean")
     */
    private $convoc_externe;

    /**
     * @var boolean
     *
     * @ORM\Column(name="convoc_banquet", type="boolean")
     */
    private $convoc_banquet;

    /**
     * @var boolean
     *
     * @ORM\Column(name="convoc_we", type="boolean")
     */
    private $convoc_we;

    /**
     * @var boolean
     *
     * @ORM\Column(name="convoc_ephemerides_q1", type="boolean")
     */
    private $convoc_ephemerides_q1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="convoc_ephemerides_q2", type="boolean")
     */
    private $convoc_ephemerides_q2;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->whoswho               = false;
        $this->pereat                = false;
        $this->convoc_externe        = false;
        $this->convoc_banquet        = false;
        $this->convoc_we             = false;
        $this->convoc_ephemerides_q1 = false;
        $this->convoc_ephemerides_q2 = false;
    }

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
     * Set Who's Who.
     *
     * @param boolean $whoswho
     *
     * @return self
     */
    public function setWhoswho($whoswho)
    {
        $this->whoswho = $whoswho;

        return $this;
    }

    /**
     * Get whoswho.
     *
     * @return boolean
     */
    public function getWhoswho()
    {
        return $this->whoswho;
    }

    /**
     * Set pereat.
     *
     * @param boolean $pereat
     *
     * @return self
     */
    public function setPereat($pereat)
    {
        $this->pereat = $pereat;

        return $this;
    }

    /**
     * Get pereat.
     *
     * @return boolean
     */
    public function getPereat()
    {
        return $this->pereat;
    }

    /**
     * Set convoc_externe.
     *
     * @param boolean $convocExterne
     *
     * @return self
     */
    public function setConvocExterne($convocExterne)
    {
        $this->convoc_externe = $convocExterne;

        return $this;
    }

    /**
     * Get convoc_externe.
     *
     * @return self
     *
     * @return boolean
     */
    public function getConvocExterne()
    {
        return $this->convoc_externe;
    }

    /**
     * Set convoc_banquet.
     *
     * @param boolean $convocBanquet
     *
     * @return self
     */
    public function setConvocBanquet($convocBanquet)
    {
        $this->convoc_banquet = $convocBanquet;

        return $this;
    }

    /**
     * Get convoc_banquet.
     *
     * @return boolean
     */
    public function getConvocBanquet()
    {
        return $this->convoc_banquet;
    }

    /**
     * Set convoc_we.
     *
     * @param boolean $convocWe
     *
     * @return self
     */
    public function setConvocWe($convocWe)
    {
        $this->convoc_we = $convocWe;

        return $this;
    }

    /**
     * Get convoc_we.
     *
     * @return boolean
     */
    public function getConvocWe()
    {
        return $this->convoc_we;
    }

    /**
     * Set convoc_ephemerides_q1.
     *
     * @param boolean $convocEphemeridesQ1
     *
     * @return self
     */
    public function setConvocEphemeridesQ1($convocEphemeridesQ1)
    {
        $this->convoc_ephemerides_q1 = $convocEphemeridesQ1;

        return $this;
    }

    /**
     * Get convoc_ephemerides_q1.
     *
     * @return boolean
     */
    public function getConvocEphemeridesQ1()
    {
        return $this->convoc_ephemerides_q1;
    }

    /**
     * Set convoc_ephemerides_q2.
     *
     * @param boolean $convocEphemeridesQ2
     *
     * @return self
     */
    public function setConvocEphemeridesQ2($convocEphemeridesQ2)
    {
        $this->convoc_ephemerides_q2 = $convocEphemeridesQ2;

        return $this;
    }

    /**
     * Get convoc_ephemerides_q2.
     *
     * @return boolean
     */
    public function getConvocEphemeridesQ2()
    {
        return $this->convoc_ephemerides_q2;
    }

    /**
     * Auto-render on toString.
     *
     * @return string
     */
    public function __toString()
    {
        return '';
    }
}
