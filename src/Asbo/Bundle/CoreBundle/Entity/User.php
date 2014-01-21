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

use Sonata\UserBundle\Entity\BaseUser as BaseUser;
use Symfony\Component\Security\Core\User\UserInterface;
use FOS\MessageBundle\Model\ParticipantInterface;
use Asbo\Bundle\WhosWhoBundle\Model\FraUserInterface;

/**
 * Represent an User entity.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class User extends BaseUser implements ParticipantInterface, FraUserInterface
{
    /**
     * @var integer $id
     */
    protected $id;

    /**
     * @var \Doctrine\Common\Collections\Collection $groups
     */
    protected $groups;

    /**
     * @var string $githubId
     */
    protected $githubId;

    /**
     * @var string $linkedinId
     */
    protected $linkedinId;

    /**
     * @var string $slug
     */
    private $slug;

    /**
     * The github id.
     *
     * @param string
     *
     * @return self
     */
    public function setGithubId($githubId)
    {
        $this->githubId = $githubId;

        return $this;
    }

    /**
     * Get the github id.
     *
     * @return string
     */
    public function getGithubId()
    {
        return $this->githubId;
    }

    /**
     * The linkedin id.
     *
     * @param string
     *
     * @return self
     */
    public function setLinkedinId($linkedinId)
    {
        $this->linkedinId = $linkedinId;

        return $this;
    }

    /**
     * Get the linkedin id.
     *
     * @return string
     */
    public function getLinkedinId()
    {
        return $this->linkedinId;
    }

    /**
     * Get slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set slug.
     *
     * @param string $slug
     *
     * @return self
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isEqualTo(UserInterface $user)
    {
        return $this->isUser($user);
    }

    /**
     * {@inheritdoc}
     */
    public function setEmail($email)
    {
        parent::setEmail($email);

        if ($this->username === null) {
            $this->setUsername($email);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setEmailCanonical($emailCanonical)
    {
        parent::setEmailCanonical($emailCanonical);

        if ($this->usernameCanonical === null) {
            $this->setUsernameCanonical($emailCanonical);
        }

        return $this;
    }
}
