<?php

namespace spec\Asbo\Bundle\WhosWhoBundle\Entity;

use Asbo\Bundle\WhosWhoBundle\Model\Status\FraStatus;
use Asbo\Bundle\WhosWhoBundle\Model\Types\FraTypes;
use PhpSpec\ObjectBehavior;

class FraSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\WhosWhoBundle\Entity\Fra');
    }

    public function it_has_no_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    public function it_has_no_first_name_by_default()
    {
        $this->getFirstName()->shouldReturn(null);
    }

    public function its_first_name_is_mutable()
    {
        $this->setFirstName('John');
        $this->getFirstName()->shouldReturn('John');
    }

    public function it_has_no_last_name_by_default()
    {
        $this->getLastName()->shouldReturn(null);
    }

    public function its_last_name_is_mutable()
    {
        $this->setLastName('Doe');
        $this->getLastName()->shouldReturn('Doe');
    }

    public function it_has_no_nick_name_by_default()
    {
        $this->getNickName()->shouldReturn(null);
    }

    public function its_nick_name_is_mutable()
    {
        $this->setNickName('Bar');
        $this->getNickName()->shouldReturn('Bar');
    }

    public function it_returns_correct_full_name()
    {
        $this->setFirstName('John');
        $this->setLastName('Doe');

        $this->getFullName()->shouldReturn('John Doe');
    }

    public function it_returns_correct_full_name_with_nickname()
    {
        $this->setFirstName('John');
        $this->setLastName('Doe');
        $this->setNickName('Bar');
        $this->getFullName()->shouldReturn('John "Bar" Doe');
    }

    public function it_has_gender_male_by_default()
    {
        $this->getGender()->shouldReturn('m');
    }

    public function its_gender_is_mutable()
    {
        $this->setGender('female');
        $this->getGender()->shouldReturn('female');
    }

    public function it_has_no_birthplace_by_default()
    {
        $this->getBirthplace()->shouldReturn(null);
    }

    public function its_birthplace_is_mutable()
    {
        $this->setBirthplace('Bruxelles');
        $this->getBirthplace()->shouldReturn('Bruxelles');
    }

    public function it_has_no_deathplace_by_default()
    {
        $this->getBirthplace()->shouldReturn(null);
    }

    public function its_deathplace_is_mutable()
    {
        $this->setDeathplace('Paris');
        $this->getDeathplace()->shouldReturn('Paris');
    }

    public function it_is_not_pontif_by_default()
    {
        $this->isPontif()->shouldReturn(false);
    }

    public function it_can_be_pontif()
    {
        $this->setPontif(true);
        $this->isPontif()->shouldReturn(true);
    }

    public function it_is_not_contributor_by_default()
    {
        $this->isContributor()->shouldReturn(false);
    }

    public function it_can_be_contributor()
    {
        $this->setContributor(true);
        $this->isContributor()->shouldReturn(true);
    }

    public function it_has_no_birthday_date_by_default()
    {
        $this->getBirthday()->shouldReturn(null);
    }

    public function its_birthday_date_is_mutable()
    {
        $date = new \DateTime('1 hour ago');

        $this->setBirthday($date);
        $this->getBirthday()->shouldReturn($date);
    }

    public function it_has_no_deathday_date_by_default()
    {
        $this->getdeathday()->shouldReturn(null);
    }

    public function its_deathday_date_is_mutable()
    {
        $date = new \DateTime('1 hour ago');

        $this->setdeathday($date);
        $this->getdeathday()->shouldReturn($date);
    }

    public function it_can_be_return_the_age()
    {
        $this->setBirthday(new \DateTime('2 year ago'));
        $this->getAge()->shouldReturn('2');
    }

    public function it_can_be_return_the_age_when_he_is_dead()
    {
        $this->setBirthday(new \DateTime('2 year ago'));
        $this->setDeathday(new \DateTime('1 year ago'));
        $this->getAge()->shouldReturn('1');
    }

    public function it_has_type_impetrant_by_default()
    {
        $this->getType()->shouldReturn(FraTypes::IMPETRANT);
    }

    public function its_type_is_mutable()
    {
        $this->setType(FraTypes::CHEVALIER);
        $this->getType()->shouldReturn(FraTypes::CHEVALIER);
    }

    public function its_type_can_take_only_specific_values()
    {
        $id = uniqid();
        $this->shouldThrow(new \InvalidArgumentException('Wrong type, "'.$id.'" given.'))->duringSetType($id);
    }

    public function it_has_status_tyro_by_default()
    {
        $this->getStatus()->shouldReturn(FraStatus::TYRO);
    }

    public function its_status_is_mutable()
    {
        $this->setStatus(FraStatus::CAPPELANUS);
        $this->getStatus()->shouldReturn(FraStatus::CAPPELANUS);
    }

    public function its_status_can_take_only_specific_values()
    {
        $id = uniqid();
        $this->shouldThrow(new \InvalidArgumentException('Wrong status, "'.$id.'" given.'))->duringSetStatus($id);
    }

    public function it_has_no_anno_by_default()
    {
        $this->getAnno()->shouldReturn(null);
    }

    public function its_anno_is_muttable()
    {
        $this->setAnno(24);
        $this->getAnno()->shouldReturn(24);
    }

    public function it_creates_fra_has_user_collection_by_default()
    {
        $this->getFraHasUsers()->shouldHaveType('Doctrine\\Common\\Collections\\Collection');
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\FraHasUser $fraHasUser
     */
    public function it_adds_fra_has_user_properly($fraHasUser)
    {
        $this->getFraHasUsers()->contains($fraHasUser)->shouldReturn(false);

        $fraHasUser->setFra($this)->shouldBeCalled();

        $this->addFraHasUser($fraHasUser);
        $this->getFraHasUsers()->contains($fraHasUser)->shouldReturn(true);
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\FraHasUser $fraHasUser
     */
    public function it_removes_fra_has_user_properly($fraHasUser)
    {
        $this->getFraHasUsers()->contains($fraHasUser)->shouldReturn(false);

        $this->addFraHasUser($fraHasUser);
        $this->getFraHasUsers()->contains($fraHasUser)->shouldReturn(true);

        $this->removeFraHasUser($fraHasUser);
        $this->getFraHasUsers()->contains($fraHasUser)->shouldReturn(false);
    }

    public function it_has_no_owner_by_default()
    {
        $this->getOwner()->shouldReturn(null);
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\FraHasUser      $fraHasUser
     * @param \Asbo\Bundle\WhosWhoBundle\Model\FraUserInterface $user
     */
    public function its_can_return_the_owner_if_there_exists($fraHasUser, $user)
    {
        $fraHasUser->isOwner()->willReturn(true);
        $fraHasUser->getUser()->willReturn($user);
        $fraHasUser->setFra($this)->shouldBeCalled();

        $this->addFraHasUser($fraHasUser);
        $this->getOwner()->shouldReturn($user);
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\FraHasUser $fraHasUser
     */
    public function its_return_no_owner_if_there_do_not_exists($fraHasUser)
    {
        $fraHasUser->isOwner()->willReturn(false);
        $fraHasUser->setFra($this)->shouldBeCalled();

        $this->addFraHasUser($fraHasUser);
        $this->getOwner()->shouldReturn(null);
    }

    public function it_creates_fra_has_post_collection_by_default()
    {
        $this->getFraHasPosts()->shouldHaveType('Doctrine\\Common\\Collections\\Collection');
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\FraHasPost $fraHasPost
     */
    public function it_adds_fra_has_post_properly($fraHasPost)
    {
        $this->getFraHasPosts()->contains($fraHasPost)->shouldReturn(false);

        $fraHasPost->setFra($this)->shouldBeCalled();

        $this->addFraHasPost($fraHasPost);
        $this->getFraHasPosts()->contains($fraHasPost)->shouldReturn(true);
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\FraHasPost $fraHasPost
     */
    public function it_removes_fra_has_post_properly($fraHasPost)
    {
        $this->getFraHasPosts()->contains($fraHasPost)->shouldReturn(false);

        $this->addFraHasPost($fraHasPost);
        $this->getFraHasPosts()->contains($fraHasPost)->shouldReturn(true);

        $this->removeFraHasPost($fraHasPost);
        $this->getFraHasPosts()->contains($fraHasPost)->shouldReturn(false);
    }

    public function it_creates_fra_has_image_collection_by_default()
    {
        $this->getFraHasImages()->shouldHaveType('Doctrine\\Common\\Collections\\Collection');
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\FraHasImage $fraHasImage
     */
    public function it_adds_fra_has_image_properly($fraHasImage)
    {
        $this->getFraHasImages()->contains($fraHasImage)->shouldReturn(false);

        $fraHasImage->setFra($this)->shouldBeCalled();

        $this->addFraHasImage($fraHasImage);
        $this->getFraHasImages()->contains($fraHasImage)->shouldReturn(true);
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\FraHasImage $fraHasImage
     */
    public function it_removes_fra_has_image_properly($fraHasImage)
    {
        $this->getFraHasImages()->contains($fraHasImage)->shouldReturn(false);

        $this->addFraHasImage($fraHasImage);
        $this->getFraHasImages()->contains($fraHasImage)->shouldReturn(true);

        $this->removeFraHasImage($fraHasImage);
        $this->getFraHasImages()->contains($fraHasImage)->shouldReturn(false);
    }

    public function it_has_no_principal_email_by_default()
    {
        $this->getPrincipalEmail()->shouldReturn(null);
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Email $email
     */
    public function its_principal_email_is_muttable($email)
    {
        $this->setPrincipalEmail($email);
        $this->getPrincipalEmail()->shouldReturn($email);
    }

    public function it_has_no_principal_Address_by_default()
    {
        $this->getPrincipalAddress()->shouldReturn(null);
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Address $address
     */
    public function its_principal_address_is_muttable($address)
    {
        $this->setPrincipalAddress($address);
        $this->getPrincipalAddress()->shouldReturn($address);
    }

    public function it_has_no_principal_phone_by_default()
    {
        $this->getPrincipalPhone()->shouldReturn(null);
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Phone $phone
     */
    public function its_principal_phone_is_muttable($phone)
    {
        $this->setPrincipalPhone($phone);
        $this->getPrincipalPhone()->shouldReturn($phone);
    }

    public function it_creates_emails_collection_by_default()
    {
        $this->getEmails()->shouldHaveType('Doctrine\\Common\\Collections\\Collection');
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Email $email
     */
    public function it_adds_email_properly($email)
    {
        $this->getEmails()->contains($email)->shouldReturn(false);

        $email->setFra($this)->shouldBeCalled();

        $this->addEmail($email);
        $this->getEmails()->contains($email)->shouldReturn(true);
        $this->getPrincipalEmail()->shouldReturn($email);
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Email $email
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Email $principalEmail
     */
    public function it_adds_email_properly_without_principal_email($email, $principalEmail)
    {
        $this->setPrincipalEmail($principalEmail);
        $this->getEmails()->contains($email)->shouldReturn(false);
        $email->setFra($this)->shouldBeCalled();

        $this->addEmail($email);
        $this->getEmails()->contains($email)->shouldReturn(true);
        $this->getPrincipalEmail()->shouldReturn($principalEmail);
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Email $email
     */
    public function it_removes_email_properly($email)
    {
        $this->getEmails()->contains($email)->shouldReturn(false);

        $this->addEmail($email);
        $this->getEmails()->contains($email)->shouldReturn(true);
        $this->getPrincipalEmail()->shouldReturn($email);

        $this->removeEmail($email);
        $this->getEmails()->contains($email)->shouldReturn(false);
        $this->getPrincipalEmail()->shouldReturn(null);
    }

    public function it_creates_phones_collection_by_default()
    {
        $this->getPhones()->shouldHaveType('Doctrine\\Common\\Collections\\Collection');
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Phone $phone
     */
    public function it_adds_phone_properly($phone)
    {
        $this->getPhones()->contains($phone)->shouldReturn(false);

        $phone->setFra($this)->shouldBeCalled();

        $this->addPhone($phone);
        $this->getPhones()->contains($phone)->shouldReturn(true);
        $this->getPrincipalPhone()->shouldReturn($phone);
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Phone $phone
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Phone $principalPhone
     */
    public function it_adds_phone_properly_without_principal_phone($phone, $principalPhone)
    {
        $this->setPrincipalPhone($principalPhone);
        $this->getPhones()->contains($phone)->shouldReturn(false);
        $phone->setFra($this)->shouldBeCalled();

        $this->addPhone($phone);
        $this->getPhones()->contains($phone)->shouldReturn(true);
        $this->getPrincipalPhone()->shouldReturn($principalPhone);
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Phone $phone
     */
    public function it_removes_phone_properly($phone)
    {
        $this->getPhones()->contains($phone)->shouldReturn(false);

        $this->addPhone($phone);
        $this->getPhones()->contains($phone)->shouldReturn(true);
        $this->getPrincipalPhone()->shouldReturn($phone);

        $this->removePhone($phone);
        $this->getPhones()->contains($phone)->shouldReturn(false);
        $this->getPrincipalPhone()->shouldReturn(null);
    }

    public function it_creates_address_collection_by_default()
    {
        $this->getAddresses()->shouldHaveType('Doctrine\\Common\\Collections\\Collection');
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Address $address
     */
    public function it_adds_address_properly($address)
    {
        $this->getAddresses()->contains($address)->shouldReturn(false);

        $address->setFra($this)->shouldBeCalled();

        $this->addAddress($address);
        $this->getAddresses()->contains($address)->shouldReturn(true);
        $this->getPrincipalAddress()->shouldReturn($address);
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Address $address
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Address $principalAddress
     */
    public function it_adds_address_properly_without_principal_address($address, $principalAddress)
    {
        $this->setPrincipalAddress($principalAddress);
        $this->getAddresses()->contains($address)->shouldReturn(false);
        $address->setFra($this)->shouldBeCalled();

        $this->addAddress($address);
        $this->getAddresses()->contains($address)->shouldReturn(true);
        $this->getPrincipalAddress()->shouldReturn($principalAddress);
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Address $address
     */
    public function it_removes_address_properly($address)
    {
        $this->getAddresses()->contains($address)->shouldReturn(false);

        $this->addAddress($address);
        $this->getAddresses()->contains($address)->shouldReturn(true);
        $this->getPrincipalAddress()->shouldReturn($address);

        $this->removeAddress($address);
        $this->getAddresses()->contains($address)->shouldReturn(false);
        $this->getPrincipalAddress()->shouldReturn(null);
    }

    public function it_creates_external_post_collection_by_default()
    {
        $this->getExternalPosts()->shouldHaveType('Doctrine\\Common\\Collections\\Collection');
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\ExternalPost $externalPost
     */
    public function it_adds_external_post_properly($externalPost)
    {
        $this->getExternalPosts()->contains($externalPost)->shouldReturn(false);

        $externalPost->setFra($this)->shouldBeCalled();

        $this->addExternalPost($externalPost);
        $this->getExternalPosts()->contains($externalPost)->shouldReturn(true);
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\ExternalPost $externalPost
     */
    public function it_removes_external_post_properly($externalPost)
    {
        $this->getExternalPosts()->contains($externalPost)->shouldReturn(false);

        $this->addExternalPost($externalPost);
        $this->getExternalPosts()->contains($externalPost)->shouldReturn(true);

        $this->removeExternalPost($externalPost);
        $this->getExternalPosts()->contains($externalPost)->shouldReturn(false);
    }

    public function it_creates_family_collection_by_default()
    {
        $this->getFamilies()->shouldHaveType('Doctrine\\Common\\Collections\\Collection');
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Family $family
     */
    public function it_adds_family_properly($family)
    {
        $this->getFamilies()->contains($family)->shouldReturn(false);

        $family->setFra($this)->shouldBeCalled();

        $this->addFamily($family);
        $this->getFamilies()->contains($family)->shouldReturn(true);
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Family $family
     */
    public function it_removes_family_properly($family)
    {
        $this->getFamilies()->contains($family)->shouldReturn(false);

        $this->addFamily($family);
        $this->getFamilies()->contains($family)->shouldReturn(true);

        $this->removeFamily($family);
        $this->getFamilies()->contains($family)->shouldReturn(false);
    }

    public function it_creates_diploma_collection_by_default()
    {
        $this->getDiplomas()->shouldHaveType('Doctrine\\Common\\Collections\\Collection');
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Diploma $diploma
     */
    public function it_adds_diploma_properly($diploma)
    {
        $this->getDiplomas()->contains($diploma)->shouldReturn(false);

        $diploma->setFra($this)->shouldBeCalled();

        $this->addDiploma($diploma);
        $this->getDiplomas()->contains($diploma)->shouldReturn(true);
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Diploma $diploma
     */
    public function it_removes_diploma_properly($diploma)
    {
        $this->getDiplomas()->contains($diploma)->shouldReturn(false);

        $this->addDiploma($diploma);
        $this->getDiplomas()->contains($diploma)->shouldReturn(true);

        $this->removeDiploma($diploma);
        $this->getDiplomas()->contains($diploma)->shouldReturn(false);
    }

    public function it_creates_rank_collection_by_default()
    {
        $this->getRanks()->shouldHaveType('Doctrine\\Common\\Collections\\Collection');
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Rank $rank
     */
    public function it_adds_rank_properly($rank)
    {
        $this->getRanks()->contains($rank)->shouldReturn(false);

        $rank->setFra($this)->shouldBeCalled();

        $this->addRank($rank);
        $this->getRanks()->contains($rank)->shouldReturn(true);
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Rank $rank
     */
    public function it_removes_rank_properly($rank)
    {
        $this->getRanks()->contains($rank)->shouldReturn(false);

        $this->addRank($rank);
        $this->getRanks()->contains($rank)->shouldReturn(true);

        $this->removeRank($rank);
        $this->getRanks()->contains($rank)->shouldReturn(false);
    }

    public function it_creates_job_collection_by_default()
    {
        $this->getJobs()->shouldHaveType('Doctrine\\Common\\Collections\\Collection');
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Job $job
     */
    public function it_adds_job_properly($job)
    {
        $this->getJobs()->contains($job)->shouldReturn(false);

        $job->setFra($this)->shouldBeCalled();

        $this->addJob($job);
        $this->getJobs()->contains($job)->shouldReturn(true);
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Job $job
     */
    public function it_removes_job_properly($job)
    {
        $this->getJobs()->contains($job)->shouldReturn(false);

        $this->addJob($job);
        $this->getJobs()->contains($job)->shouldReturn(true);

        $this->removeJob($job);
        $this->getJobs()->contains($job)->shouldReturn(false);
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\FraHasUser   $fraHasUser
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\FraHasPost   $fraHasPost
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\FraHasImage  $fraHasImage
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Email        $email
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Address      $address
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Phone        $phone
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Family       $family
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\ExternalPost $externalPost
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Rank         $rank
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Job          $job
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Settings     $settings
     *
     */
    public function it_has_fluent_interface($fraHasUser, $fraHasPost, $fraHasImage, $email, $phone, $address, $externalPost, $family, $rank, $job, $settings)
    {
        $this->setFirstName('John')->shouldReturn($this);
        $this->setLastName('Doe')->shouldReturn($this);
        $this->setNickName('Bar')->shouldReturn($this);
        $this->setBirthday(new \Datetime())->shouldReturn($this);
        $this->setBirthplace('Bruxelles')->shouldReturn($this);
        $this->setDeathDay(new \DateTime())->shouldReturn($this);
        $this->setDeathplace('Paris')->shouldReturn($this);
        $this->setType(FraTypes::CHEVALIER)->shouldReturn($this);
        $this->setStatus(FraStatus::CHEVALIER)->shouldReturn($this);
        $this->setPontif(true)->shouldReturn($this);
        $this->setAnno(24)->shouldReturn($this);
        $this->addFraHasUser($fraHasUser)->shouldReturn($this);
        $this->removeFraHasUser($fraHasUser)->shouldReturn($this);
        $this->addFraHasPost($fraHasPost)->shouldReturn($this);
        $this->addFraHasImage($fraHasImage)->shouldReturn($this);
        $this->addEmail($email)->shouldReturn($this);
        $this->setPrincipalEmail($email)->shouldReturn($this);
        $this->addPhone($phone)->shouldReturn($this);
        $this->setPrincipalPhone($phone)->shouldReturn($this);
        $this->addAddress($address)->shouldReturn($this);
        $this->setPrincipalAddress($address)->shouldReturn($this);
        $this->addRank($rank)->shouldReturn($this);
        $this->addExternalPost($externalPost)->shouldReturn($this);
        $this->addJob($job)->shouldReturn($this);
        $this->addFamily($family)->shouldReturn($this);
        $this->setSettings($settings)->shouldReturn($this);
        $this->setSlug('slug')->shouldReturn($this);
    }

    public function it_can_be_convert_to_string()
    {
        $this->setFirstName('John');
        $this->setLastName('Doe');
        $this->setNickName('Bar');

        $this->__toString()->shouldReturn($this->getFullName());
    }

    public function it_creates_settings_by_default()
    {
        $this->getSettings()->shouldHaveType('Asbo\\Bundle\\WhosWhoBundle\\Entity\\Settings');
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Settings $settings
     */
    public function its_settings_are_muttable($settings)
    {
        $old = $this->getSettings();
        $this->setSettings($settings);
        $this->getSettings()->shouldNotReturn($old);
        $this->getSettings()->shouldReturn($settings);
    }

    public function it_has_no_slug_by_default()
    {
        $this->getSlug()->shouldReturn(null);
    }

    public function its_slug_is_muttable()
    {
        $this->setSlug($slug = uniqid());
        $this->getSlug()->shouldReturn($slug);
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\FraHasPost $fraHasPost1
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\FraHasPost $fraHasPost2
     *
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Post $post1
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Post $post2
     *
     */
    public function its_calculates_correct_total_deniers($fraHasPost1, $fraHasPost2, $post1, $post2)
    {
        $fraHasPost1->getPost()->shouldBeCalled();
        $fraHasPost2->getPost()->shouldBeCalled();

        $fraHasPost1->getPost()->willReturn($post1);
        $fraHasPost2->getPost()->willReturn($post2);

        $post1->getDenier()->shouldBeCalled();
        $post2->getDenier()->shouldBeCalled();

        $post1->getDenier()->willReturn(4);
        $post2->getDenier()->willReturn(3);

        $fraHasPost1->setFra($this)->shouldBeCalled();
        $fraHasPost2->setFra($this)->shouldBeCalled();

        $this->addFraHaspost($fraHasPost1);
        $this->addFraHaspost($fraHasPost2);

        $this->getTotalDenier()->shouldReturn(7);
    }

}
