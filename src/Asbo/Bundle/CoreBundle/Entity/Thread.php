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

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use FOS\MessageBundle\Entity\Thread as BaseThread;
use FOS\MessageBundle\Model\ParticipantInterface;
use FOS\MessageBundle\Model\MessageInterface;
use FOS\MessageBundle\Model\ThreadMetadata as ModelThreadMetadata;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Represent a Thread entity
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 *
 * @ORM\Table(name="message__thread")
 * @ORM\Entity()
 */
class Thread extends BaseThread
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\generatedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Asbo\Bundle\CoreBundle\Entity\User")
     */
    protected $createdBy;

    /**
     * @ORM\OneToMany(targetEntity="Asbo\Bundle\CoreBundle\Entity\Message", mappedBy="thread")
     */
    protected $messages;

    /**
     * @ORM\OneToMany(targetEntity="Asbo\Bundle\CoreBundle\Entity\ThreadMetadata", mappedBy="thread", cascade={"all"})
     */
    protected $metadata;

    public function __construct()
    {
        parent::__construct();

        $this->messages = new ArrayCollection();
    }

    public function setCreatedBy(ParticipantInterface $participant)
    {
            $this->createdBy = $participant;

            return $this;
    }

    public function addMessage(MessageInterface $message)
    {
            $this->messages->add($message);
    }

    public function addMetadata(ModelThreadMetadata $meta)
    {
        $meta->setThread($this);
        parent::addMetadata($meta);
    }

    public function getAllParticipants()
    {
        $participants = array();

        foreach ($this->metadata as $metadata) {
            $user = $metadata->getParticipant();
            $participants[$user->getId()] = $user;
        }

        return $participants;
    }

    public function getAllParticipantsWithoutUser(UserInterface $user)
    {
        $participants = $this->getAllParticipants();

        if (isset($participants[$user->getId()])) {
            unset($participants[$user->getId()]);
        }

        return $participants;
    }
}
