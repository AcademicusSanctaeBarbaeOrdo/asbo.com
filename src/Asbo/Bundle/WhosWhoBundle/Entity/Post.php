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

use Asbo\Bundle\WhosWhoBundle\Model\Types\PostTypes;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Represent a Post Entity.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 *
 * @ORM\Table(name="ww__post")
 * @ORM\Entity(repositoryClass="Asbo\Bundle\WhosWhoBundle\Doctrine\EntityRepository")
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     * @Assert\Length(min="1", max="50")
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="string", length=10)
     * @Assert\Choice(callback = {"Asbo\Bundle\WhosWhoBundle\Model\Types\PostTypes", "getCallbackValidation"})
     */
    private $type = PostTypes::CONSEIL;

    /**
     * C'est justifié d'utiliser un champ pour les deniers car les deniers
     * sont répartis en fonction du type de post SAUF pour le magister.
     * Il est donc plus facile de calculer ça comme ça que de faire une exception.
     * On garde de la flexibilité en cas de changement.
     *
     * @var integer $denier
     *
     * @ORM\Column(name="denier", type="integer")
     * @Assert\Type(type="integer")
     * @Assert\Range(min="0")
     */
    private $denier;

    /**
     * @var string
     *
     * @ORM\Column(name="monogramme", type="string", length=10, nullable=true)
     * @Assert\Length(min="1", max="50")
     */
    private $monogramme;

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
     * Set monogramme.
     *
     * @param string $monogramme
     *
     * @return self
     */
    public function setMonogramme($monogramme)
    {
        $this->monogramme = $monogramme;

        return $this;
    }

    /**
     * Get monogramme.
     *
     * @return string
     */
    public function getMonogramme()
    {
        return $this->monogramme;
    }

    /**
     * Set type.
     *
     * @param string $type
     *
     * @throws \InvalidArgumentException
     * @return self
     */
    public function setType($type)
    {
        if (!array_key_exists($type, PostTypes::getChoices())) {
            throw new \InvalidArgumentException(
                sprintf('Wrong type, "%s" given.', $type)
            );
        }

        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set denier.
     *
     * @param integer $denier
     *
     * @return self
     */
    public function setDenier($denier)
    {
        $this->denier = $denier;

        return $this;
    }

    /**
     * Get denier.
     *
     * @return integer
     */
    public function getDenier()
    {
        return $this->denier;
    }

    /**
     * Auto-render on toString.
     *
     * @return string
     */
    public function __toString()
    {
        $return = $this->name;

        if (!empty($this->monogramme)) {
            $return .= ' ('.$this->monogramme.')';
        }

        return $return;
    }
}
