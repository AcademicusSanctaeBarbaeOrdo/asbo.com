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
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Asbo\Bundle\WhosWhoBundle\Model\Types\FraTypes;
Use Asbo\Bundle\WhosWhoBundle\Model\Status\FraStatus;
use Asbo\Bundle\WhosWhoBundle\Validator;

/**
 * Represent a Fra Entity
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 *
 * @ORM\Table(name="ww__fra", indexes={@ORM\Index(name="identifier", columns={"slug"})})
 * @ORM\Entity(repositoryClass="Asbo\Bundle\WhosWhoBundle\Doctrine\FraRepository")

 * @Assert\Callback(methods={
 *     { "Asbo\Bundle\WhosWhobundle\Validator\StatusTypeValidator", "isValid"}
 * })
 */
class Fra
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
     * @ORM\Column(name="firstname", type="string", length=50)
     * @Assert\NotBlank()
     * @Assert\Length(max=50)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=50)
     * @Assert\NotBlank()
     * @Assert\Length(max=50)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="nickname", type="string", length=50, nullable=true)
     * @Assert\Length(max=50)
     */
    private $nickname;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=1)
     * @Assert\Choice(choices = {"m", "f"})
     */
    private $gender;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="date", nullable=true)
     * @Assert\date
     */
    private $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="birthplace", type="string", length=50, nullable=true)
     */
    private $birthplace;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deathday", type="date", nullable=true)
     * @Assert\date
     */
    private $deathday;

    /**
     * @var string
     *
     * @ORM\Column(name="deathplace", type="string", length=50, nullable=true)
     */
    private $deathplace;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=15)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=15)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="anno", type="integer")
     * @Validator\Anno()
     */
    private $anno;

    /**
     * @var boolean
     *
     * @ORM\Column(name="pontif", type="boolean", nullable=true)
     */
    private $pontif;

    /**
     * @var boolean
     *
     * @ORM\Column(name="contributor", type="boolean", nullable=true)
     */
    private $contributor;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=100)
     * @Gedmo\Slug(fields={"firstname", "lastname"}, updatable=false, unique=true, separator="")
     */
    private $slug;

    /**
     * @var FraHasUser[]
     *
     * @ORM\OneToMany(targetEntity="Asbo\Bundle\WhosWhoBundle\Entity\FraHasUser", mappedBy="fra", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $fraHasUsers;

    /**
     * @var FrahasPost[]
     *
     * @ORM\OneToMany(targetEntity="Asbo\Bundle\WhosWhoBundle\Entity\FraHasPost", mappedBy="fra", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"anno" = "ASC", "civilyear" = "ASC"})
     */
    private $fraHasPosts;

    /**
     * @var FraHasImage[]
     *
     * @ORM\OneToMany(targetEntity="Asbo\Bundle\WhosWhoBundle\Entity\FraHasImage", mappedBy="fra", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $fraHasImages;

    /**
     * @var FraHasImage
     *
     * @ORM\OneToOne(targetEntity="Asbo\Bundle\WhosWhoBundle\Entity\FraHasImage", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $principalImage;

    /**
     * @var Email[]
     *
     * @ORM\OneToMany(targetEntity="Asbo\Bundle\WhosWhoBundle\Entity\Email", mappedBy="fra", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $emails;

    /**
     * @var Email
     *
     * @ORM\OneToOne(targetEntity="Asbo\Bundle\WhosWhoBundle\Entity\Email", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $principalEmail;

    /**
     * @var Diploma[]
     *
     * @ORM\OneToMany(targetEntity="Asbo\Bundle\WhosWhoBundle\Entity\Diploma", mappedBy="fra", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"graduatedAt" = "DESC"})
     */
    private $diplomas;

    /**
     * @var Phone[]
     *
     * @ORM\OneToMany(targetEntity="Asbo\Bundle\WhosWhoBundle\Entity\Phone", mappedBy="fra", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $phones;

    /**
     * @var Phone
     *
     * @ORM\OneToOne(targetEntity="Asbo\Bundle\WhosWhoBundle\Entity\Phone", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $principalPhone;

    /**
     * @var Address[]
     *
     * @ORM\OneToMany(targetEntity="Asbo\Bundle\WhosWhoBundle\Entity\Address", mappedBy="fra", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $addresses;

    /**
     * @var Address
     *
     * @ORM\OneToOne(targetEntity="Asbo\Bundle\WhosWhoBundle\Entity\Address", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $principalAddress;

    /**
     * @var Job[]
     *
     * @ORM\OneToMany(targetEntity="Asbo\Bundle\WhosWhoBundle\Entity\Job", mappedBy="fra", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"dateBegin" = "ASC"})
     */
    private $jobs;

    /**
     * @var Rank[]
     *
     * @ORM\OneToMany(targetEntity="Asbo\Bundle\WhosWhoBundle\Entity\Rank", mappedBy="fra", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $ranks;

    /**
     * @var Family[]
     *
     * @ORM\OneToMany(targetEntity="Asbo\Bundle\WhosWhoBundle\Entity\Family", mappedBy="fra", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $families;

    /**
     * @var ExternalPost[]
     *
     * @ORM\OneToMany(targetEntity="Asbo\Bundle\WhosWhoBundle\Entity\ExternalPost", mappedBy="fra", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"dateBegin" = "ASC"})
     */
    private $externalPosts;

    /**
     * @var array
     *
     * @ORM\OneToOne(targetEntity="Asbo\Bundle\WhosWhoBundle\Entity\Settings", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $settings;

    /**
     * Constructor.
     */
    public function __construct()
    {

        $this->emails        = new ArrayCollection();
        $this->diplomas      = new ArrayCollection();
        $this->phones        = new ArrayCollection();
        $this->addresses     = new ArrayCollection();
        $this->jobs          = new ArrayCollection();
        $this->ranks         = new ArrayCollection();
        $this->fraHasUsers   = new ArrayCollection();
        $this->fraHasPosts   = new ArrayCollection();
        $this->fraHasImages  = new ArrayCollection();
        $this->families      = new ArrayCollection();
        $this->externalPosts = new ArrayCollection();

        $this->pontif = false;
        $this->settings = new Settings();

        // Quand on rajoute un fra il y a de forte chance pour qu'il soit
        // Tyro et que ce soit un garçon
        $this->type = fraTypes::IMPETRANT;
        $this->status = fraStatus::TYRO;
        $this->gender = 'm';
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
     * Set firstname.
     *
     * @param string $firstname
     *
     * @return self
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname.
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname.
     *
     * @param string $lastname
     *
     * @return self
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname.
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set nickname.
     *
     * @param string $nickname
     *
     * @return string
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * Get nickname.
     *
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Returns the fully qualified name
     *
     * @return string
     */
    public function getFullName()
    {
        $nickname = $this->getNickname();

        return $this->firstname. (!empty($nickname) ? ' "'.$nickname.'" ': ' ').$this->lastname;
    }

    /**
     * Set gender.
     *
     * @param string $gender
     *
     * @return self
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender.
     *
     * @return boolean
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set birthday.
     *
     * @param \DateTime $birthday
     *
     * @return self
     */
    public function setBirthday(\DateTime $birthday = null)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday.
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Returns the age of the person.
     *
     * @return string
     */
    public function getAge()
    {
        $date = new \DateTime('now');

        if ($this->deathday instanceof \DateTime) {
            $date = clone $this->deathday;
        }

        return $date->diff($this->birthday)->format('%y');
    }

    /**
     * Set deathday.
     *
     * @param \DateTime $deathday
     *
     * @return self
     */
    public function setDeathday($deathday)
    {
        $this->deathday = $deathday;

        return $this;
    }

    /**
     * Get deathday.
     *
     * @return \DateTime
     */
    public function getDeathday()
    {
        return $this->deathday;
    }

    /**
     * Set birthplace.
     *
     * @param $birthplace
     *
     * @return self
     */
    public function setBirthplace($birthplace)
    {
        $this->birthplace = $birthplace;

        return $this;
    }

    /**
     * Get birthplace.
     *
     * @return string
     */
    public function getBirthplace()
    {
        return $this->birthplace;
    }

    /**
     * Set deathplace.
     *
     * @param string $deathplace
     *
     * @return self
     */
    public function setDeathplace($deathplace)
    {
        $this->deathplace = $deathplace;

        return $this;
    }

    /**
     * Get deathplace.
     *
     * @return string
     */
    public function getDeathplace()
    {
        return $this->deathplace;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @throws \InvalidArgumentException
     * @return self
     */
    public function setType($type)
    {
        if (!array_key_exists($type, FraTypes::getChoices())) {
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
     * Set status.
     *
     * @param string $status
     *
     * @throws \InvalidArgumentException
     * @return self
     */
    public function setStatus($status)
    {
        if (!array_key_exists($status, FraStatus::getChoices())) {
            throw new \InvalidArgumentException(
                sprintf('Wrong status, "%s" given.', $status)
            );
        }

        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set anno.
     *
     * @param integer $anno
     *
     * @return self
     */
    public function setAnno($anno)
    {
        $this->anno = $anno;

        return $this;
    }

    /**
     * Get anno.
     *
     * @return integer
     */
    public function getAnno()
    {
        return $this->anno;
    }

    /**
     * Set pontif.
     *
     * @param boolean $pontif
     *
     * @return self
     */
    public function setPontif($pontif)
    {
        $this->pontif = $pontif;

        return $this;
    }

    /**
     * Get pontif.
     *
     * @return boolean
     */
    public function isPontif()
    {
        return true === $this->pontif;
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
     * Get slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get the linked users.
     *
     * @return FraHasUser[]
     */
    public function getFraHasUsers()
    {
        return $this->fraHasUsers;
    }

    /**
     * Add a link between a fra and an user.
     *
     * @param FraHasUser $fraHasUser
     *
     * @return self
     */
    public function addFraHasUser(FraHasUser $fraHasUser)
    {
        $fraHasUser->setFra($this);

        $this->fraHasUsers->add($fraHasUser);

        return $this;
    }

    /**
     * Remove a link between fra and an user.
     *
     * @param FraHasUser $fraHasUser
     *
     * @return self
     */
    public function removeFraHasUser(FraHasUser $fraHasUser)
    {
        $this->fraHasUsers->removeElement($fraHasUser);

        return $this;
    }

    /**
     * Get the user that manage the fra.
     *
     * @return \Asbo\Bundle\WhosWhoBundle\Model\FraUserInterface|null
     */
    public function getOwner()
    {
        foreach ($this->fraHasUsers as $fraHasUser) {
            if ($fraHasUser->isOwner()) {
                return $fraHasUser->getUser();
            }
        }

        return null;
    }

    /**
     * Get the linked posts.
     *
     * @return FraHasPost[]
     */
    public function getFraHasPosts()
    {
        return $this->fraHasPosts;
    }

    /**
     * Add a link betwwen post and fra.
     *
     * @param FraHasPost $fraHasPost
     *
     * @return FraHasPost[]
     */
    public function addFraHasPost(FraHasPost $fraHasPost)
    {
        $fraHasPost->setFra($this);

        $this->fraHasPosts->add($fraHasPost);

        return $this;
    }

    /**
     * Remove a link between fra and a post
     *
     * @param FraHasPost $fraHasPost
     *
     * @return self
     */
    public function removeFraHasPost(FraHasPost $fraHasPost)
    {
        $this->fraHasPosts->removeElement($fraHasPost);

        return $this;
    }

    /**
     * Add a link between an image and fra.
     *
     * @return FraHasImage[]
     */
    public function getFraHasImages()
    {
        return $this->fraHasImages;
    }

    /**
     * Add a link between an image and fra.
     *
     * @param FraHasImage $fraHasImage
     *
     * @return self
     */
    public function addFraHasImage(FraHasImage $fraHasImage)
    {
        $fraHasImage->setFra($this);

        $this->fraHasImages->add($fraHasImage);

        return $this;
    }

    /**
     * Remove a link between fra and an image.
     *
     * @param FraHasImage $fraHasImage
     *
     * @return self
     */
    public function removeFraHasImage(FraHasImage $fraHasImage)
    {
        $this->fraHasImages->removeElement($fraHasImage);

        return $this;
    }

    /**
     * Set the principal image.
     *
     * @param FraHasImage $fraHasImage
     *
     * @return self
     */
    public function setPrincipalImage(FraHasImage $fraHasImage = null)
    {
        $this->principalImage = $fraHasImage;

        return $this;
    }

    /**
     * Get the principal image.
     *
     * @return FraHasImage
     */
    public function getPrincipalImage()
    {
        return $this->principalImage;
    }

    /**
     * Get emails.
     *
     * @return array $emails
     */
    public function getEmails()
    {
        return $this->emails;
    }

    /**
     * Add an email.
     *
     * @param Email $email
     *
     * @return self
     */
    public function addEmail(Email $email)
    {
        $email->setFra($this);

        $this->emails->add($email);

        if (null === $this->getPrincipalEmail()) {
            $this->setPrincipalEmail($email);
        }

        return $this;
    }

    /**
     * Remove an email.
     *
     * @param Email $email
     *
     * @return self
     */
    public function removeEmail(Email $email)
    {
        if ($email === $this->getPrincipalEmail()) {
            $this->setPrincipalEmail(null);
        }

        $this->emails->removeElement($email);

        return $this;
    }

    /**
     * Set the principal email.
     *
     * @param Email $email
     *
     * @return self
     */
    public function setPrincipalEmail(Email $email = null)
    {
        $this->principalEmail = $email;

        return $this;
    }

    /**
     * Get the principal email.
     *
     * @return Email
     */
    public function getPrincipalEmail()
    {
        return $this->principalEmail;
    }

    /**
     * Get jobs.
     *
     * @return Job[] $jobs
     */
    public function getJobs()
    {
        return $this->jobs;
    }

    /**
     * Add a job.
     *
     * @param Job $job
     *
     * @return self
     */
    public function addJob(Job $job)
    {
        $job->setFra($this);

        $this->jobs->add($job);

        return $this;
    }

    /**
     * Remove a job.
     *
     * @param Job $job
     *
     * @return self
     */
    public function removeJob(Job $job)
    {
        $this->jobs->removeElement($job);

        return $this;
    }

    /**
     * Get ranks.
     *
     * @return rank[] $ranks
     */
    public function getRanks()
    {
        return $this->ranks;
    }

    /**
     * Add a rank.
     *
     * @param Rank $rank
     *
     * @return self
     */
    public function addRank(Rank $rank)
    {
        $rank->setFra($this);

        $this->ranks->add($rank);

        return $this;
    }

    /**
     * Remove a rank.
     *
     * @param Rank $rank
     *
     * @return self
     */
    public function removeRank(Rank $rank)
    {
        $this->ranks->removeElement($rank);

        return $this;
    }

    /**
     * Get diplomas.
     *
     * @return array $diplomas
     */
    public function getDiplomas()
    {
        return $this->diplomas;
    }

    /**
     * Add a diploma.
     *
     * @param Diploma $diploma
     *
     * @return self
     */
    public function addDiploma(Diploma $diploma)
    {
        $diploma->setFra($this);

        $this->diplomas->add($diploma);

        return $this;
    }

    /**
     * Remove a diploma.
     *
     * @param Diploma $diploma
     *
     * @return self
     */
    public function removeDiploma(Diploma $diploma)
    {
        $this->diplomas->removeElement($diploma);

        return $this;
    }

    /**
     * Get members of family.
     *
     * @return Family[] $families
     */
    public function getFamilies()
    {
        return $this->families;
    }

    /**
     * Remove a member of family.
     *
     * @param Family $family
     *
     * @return self
     */
    public function removeFamily(Family $family)
    {
        $this->families->removeElement($family);

        return $this;
    }

    /**
     * Add a membre of family.
     *
     * @param Family $family
     *
     * @return self
     */
    public function addFamily(Family $family)
    {
        $family->setFra($this);

        $this->families->add($family);

        return $this;
    }

    /**
     * Add external post.
     *
     * @param ExternalPost $externalPost
     *
     * @return self
     */
    public function addExternalPost(ExternalPost $externalPost)
    {
        $externalPost->setFra($this);

        $this->externalPosts->add($externalPost);

        return $this;
    }

    /**
     * Remove an external post.
     *
     * @param ExternalPost $externalPost
     *
     * @return self
     */
    public function removeExternalPost(ExternalPost $externalPost)
    {
        $this->externalPosts->removeElement($externalPost);

        return $this;
    }

    /**
     * Get external posts
     *
     * @return ExternalPost[] $externalPosts
     */
    public function getExternalPosts()
    {
        return $this->externalPosts;
    }

    /**
     * Get addresses.
     *
     * @return Address[] $addresses
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * Add an address.
     *
     * @param Address $address
     *
     * @return self
     */
    public function addAddress(Address $address)
    {
        $address->setFra($this);

        $this->addresses->add($address);

        if (null === $this->getPrincipalAddress()) {
            $this->setPrincipalAddress($address);
        }

        return $this;
    }

    /**
     * Remove an address.
     *
     * @param Address $address
     *
     * @return self
     */
    public function removeAddress(Address $address)
    {
        if ($address === $this->getPrincipalAddress()) {
            $this->setPrincipalAddress(null);
        }

        $this->addresses->removeElement($address);

        return $this;
    }

    /**
     * Set the principal address.
     *
     * @param Address $address
     *
     * @return self
     */
    public function setPrincipalAddress(Address $address = null)
    {
        $this->principalAddress = $address;

        return $this;
    }

    /**
     * Get the principal address.
     *
     * @return Address
     */
    public function getPrincipalAddress()
    {
        return $this->principalAddress;
    }

    /**
     * Get phones.
     *
     * @return phone[] $phones
     */
    public function getPhones()
    {
        return $this->phones;
    }

    /**
     * Add a phone.
     *
     * @param Phone $phone
     *
     * @return self
     */
    public function addPhone(Phone $phone)
    {
        $phone->setFra($this);
        $this->phones[] = $phone;

        if (null === $this->getPrincipalPhone()) {
            $this->setPrincipalPhone($phone);
        }

        return $this;
    }

    /**
     * Remove a phone number.
     *
     * @param Phone $phone
     *
     * @return self
     */
    public function removePhone(Phone $phone)
    {
        if ($phone === $this->getPrincipalPhone()) {
            $this->setPrincipalPhone(null);
        }

        $this->phones->removeElement($phone);

        return $this;
    }

    /**
     * Set the principal phone.
     *
     * @param Phone $phone
     *
     * @return self
     */
    public function setPrincipalPhone(Phone $phone = null)
    {
        $this->principalPhone = $phone;

        return $this;
    }

    /**
     * Get the principal phone.
     *
     * @return Phone
     */
    public function getPrincipalPhone()
    {
        return $this->principalPhone;
    }

    /**
     * Set settings.
     *
     * @param Settings $settings
     *
     * @return self
     */
    public function setSettings(Settings $settings)
    {
        $this->settings = $settings;

        return $this;
    }

    /**
     * Get settings.
     *
     * @return Settings
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * Is the fra a contributor ?
     *
     * @return bool
     */
    public function isContributor()
    {
        return true == $this->contributor;
    }

    /**
     * Set if the fra is a contributor or not.
     *
     * @param boolean $contributor
     *
     * @return self
     */
    public function setContributor($contributor)
    {
        $this->contributor = (bool) $contributor;

        return $this;
    }

    /**
     * Get total denier based on the posts.
     *
     * @return integer
     */
    public function getTotalDenier()
    {
        $derniers = 0;

        foreach ($this->fraHasPosts as $fraHasPost) {
            $derniers += $fraHasPost->getPost()->getDenier();
        }

        return $derniers;
    }

    /**
     * Auto-render on toString.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getFullName();
    }
}
