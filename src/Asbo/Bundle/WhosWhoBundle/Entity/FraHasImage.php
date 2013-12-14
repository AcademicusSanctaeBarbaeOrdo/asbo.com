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

use Asbo\Bundle\WhosWhoBundle\Model\FraImageInterface;
use Asbo\Bundle\WhosWhoBundle\Model\FraResourceInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Asbo\Bundle\WhosWhoBundle\Validator\Anno;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Represent a link between a fra and an image entity.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 *
 * @ORM\Table(name="ww__fra_image")
 * @ORM\Entity(repositoryClass="Asbo\Bundle\WhosWhoBundle\Doctrine\ResourceRepository")
 * @UniqueEntity(fields={"anno"}, message="Une seule photo est autorisée par anno."
 * )
 */
class FraHasImage implements FraResourceInterface
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
     * @ORM\ManyToOne(targetEntity="Asbo\Bundle\WhosWhoBundle\Entity\Fra", cascade={"persist"}, inversedBy="fraHasImages")
     * @ORM\JoinColumn(onDelete="CASCADE", nullable=false)
     * @Assert\NotNull()
     */
    protected $fra;

    /**
     * @var FraImageInterface
     *
     * @ORM\ManyToOne(targetEntity="Asbo\Bundle\WhosWhoBundle\Model\FraImageInterface", cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumn(onDelete="CASCADE", nullable=false)
     * @Assert\NotNull()
     */
    protected $image;

    /**
     * @var $anno
     *
     * @ORM\Column(name="anno", type="integer")
     * @Anno
     */
    private $anno;

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
     * @param Fra
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
     * Set image.
     *
     * @param FraImageInterface $image
     *
     * @return self
     */
    public function setImage(FraImageInterface $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image.
     *
     * @return FraImageInterface
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set anno
     *
     * @param integer $anno
     *
     * @return self
     */
    public function setAnno($anno = null)
    {
        $this->anno = $anno;

        return $this;
    }

    /**
     * Get anno
     *
     * @return integer
     */
    public function getAnno()
    {
        return $this->anno;
    }

    /**
     * Auto-render on toString.
     *
     * @return string
     */
    public function __toString()
    {
        return (string) 'Image: #'.$this->getImage()->getId();
    }
}
