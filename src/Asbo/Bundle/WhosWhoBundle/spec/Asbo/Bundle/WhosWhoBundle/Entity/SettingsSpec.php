<?php

namespace spec\Asbo\Bundle\WhosWhoBundle\Entity;

use PhpSpec\ObjectBehavior;

class SettingsSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\WhosWhoBundle\Entity\Settings');
    }

    public function it_has_no_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    public function it_has_false_by_default_for_all_settings()
    {
        $this->getWhosWho()->shouldReturn(false);
        $this->getPereat()->shouldReturn(false);
        $this->getConvocExterne()->shouldReturn(false);
        $this->getConvocBanquet()->shouldReturn(false);
        $this->getConvocWe()->shouldReturn(false);
        $this->getConvocEphemeridesQ1()->shouldReturn(false);
        $this->getConvocEphemeridesQ2()->shouldReturn(false);
    }

    public function it_settings_is_mutable()
    {
        $this->setWhosWho(true);
        $this->setPereat(true);
        $this->setConvocExterne(true);
        $this->setConvocBanquet(true);
        $this->setConvocWe(true);
        $this->setConvocEphemeridesQ1(true);
        $this->setConvocEphemeridesQ2(true);

        $this->getWhosWho()->shouldReturn(true);
        $this->getPereat()->shouldReturn(true);
        $this->getConvocExterne()->shouldReturn(true);
        $this->getConvocBanquet()->shouldReturn(true);
        $this->getConvocWe()->shouldReturn(true);
        $this->getConvocEphemeridesQ1()->shouldReturn(true);
        $this->getConvocEphemeridesQ2()->shouldReturn(true);
    }

    public function it_is_convertable_to_string_and_return_empty_string()
    {
        $this->__toString()->shouldReturn('');
    }
}
