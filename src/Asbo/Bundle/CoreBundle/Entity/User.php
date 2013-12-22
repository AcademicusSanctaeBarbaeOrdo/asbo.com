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
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Gedmo\Mapping\Annotation as Gedmo;
use FOS\MessageBundle\Model\ParticipantInterface;
use Asbo\Bundle\WhosWhoBundle\Model\FraUserInterface;

/**
 * Represent a User entity.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 *
 * @ORM\Table(name="user__user")
 * @ORM\Entity()
 */
class User extends BaseUser implements ParticipantInterface, FraUserInterface
{
    /**
     * @var integer $id
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \Doctrine\Common\Collections\Collection $groups
     *
     * @ORM\ManyToMany(targetEntity="Asbo\Bundle\CoreBundle\Entity\Group")
     * @ORM\JoinTable(name="user__user_group",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;

    /**
     * @var string $githubId
     *
     * @ORM\Column(type="string", length=40, nullable=true)
     * @Assert\NotBlank(groups={"Github"})
     */
    protected $githubId;

    /**
     * @var string $linkedinId
     *
     * @ORM\Column(type="string", length=40, nullable=true)
     * @Assert\NotBlank(groups={"Linkedin"})
     */
    protected $linkedinId;

    /**
     * @var string $slug
     *
     * @Gedmo\Slug(fields={"username"})
     * @ORM\Column(type="string", length=128, unique=true)
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
     * Get the linkedin id
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
        $this->setUsername($email);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setEmailCanonical($emailCanonical)
    {
        parent::setEmailCanonical($emailCanonical);
        $this->setUsernameCanonical($emailCanonical);

        return $this;
    }
}
