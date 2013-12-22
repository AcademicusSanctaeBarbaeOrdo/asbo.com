<?php

namespace spec\Asbo\Bundle\CoreBundle\Entity;

use PhpSpec\ObjectBehavior;

class UserSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\CoreBundle\Entity\User');
    }

    public function it_extends_Sonata_thread()
    {
        $this->shouldHaveType('Sonata\UserBundle\Entity\BaseUser');
    }

    public function it_has_no_github_id_by_default()
    {
        $this->getGithubId()->shouldReturn(null);
    }

    public function its_github_id_is_mutable()
    {
        $this->setGithubId('1234');
        $this->getGithubId()->shouldReturn('1234');
    }

    public function it_has_no_linkedin_id()
    {
        $this->getLinkedinId()->shouldReturn(null);
    }

    public function its_linkedin_id_is_mutable()
    {
        $this->setLinkedinId('1234');
        $this->getLinkedinId()->shouldReturn('1234');
    }

    public function it_has_no_slug_by_default()
    {
        $this->getSlug()->shouldReturn(null);
    }

    public function its_slug_is_mutable()
    {
        $this->setSlug('slug');
        $this->getSlug()->shouldReturn('slug');
    }

    public function it_username_is_mutable_and_is_equal_to_email()
    {
        $this->setEmail('deronmalian@gmail.com');
        $this->getUsername()->shouldReturn('deronmalian@gmail.com');

        $this->setEmailCanonical('deronmalian@gmail.coM');
        $this->getUsernameCanonical()->shouldReturn('deronmalian@gmail.coM');
    }

    public function it_has_fluent_interface()
    {
        $this->setSlug('slug')->shouldReturn($this);
        $this->setGithubId('1234')->shouldReturn($this);
        $this->setLinkedinId('1234')->shouldReturn($this);
    }

    /**
     * @param \Asbo\Bundle\CoreBundle\Entity\User $user
     */
    public function it_compare_user($user)
    {
        $user->getId()->willReturn(uniqid());
        $this->isEqualTo($user)->shouldReturn(false);
    }
}
