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
use Asbo\Bundle\WhosWhoBundle\Entity\Fra;
use Asbo\Bundle\WhosWhoBundle\Model\Types\EmailTypes;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Represent an Email Entity.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 *
 * @ORM\Table(name="ww__email")
 * @ORM\Entity(repositoryClass="Asbo\Bundle\WhosWhoBundle\Doctrine\ResourceRepository")
 * @UniqueEntity({"email", "fra"})
 */
class Email implements FraResourceInterface
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
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="string", length=10)
     * @Assert\Choice(callback = {"Asbo\Bundle\WhosWhoBundle\Model\Types\EmailTypes", "getCallbackValidation"})
     */
    private $type = EmailTypes::PRIVEE;

    /**
     * @var Fra
     *
     * @ORM\ManyToOne(targetEntity="Asbo\Bundle\WhosWhoBundle\Entity\Fra", inversedBy="emails", fetch="EAGER")
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
     * Set email.
     *
     * @param string $email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set type.
     *
     * @param string $type
     *
     * @return self
     */
    public function setType($type)
    {
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
        return (string) $this->email;
    }
}
