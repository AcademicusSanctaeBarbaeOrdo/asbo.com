<?php

namespace spec\Asbo\Bundle\WhosWhoBundle\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DiplomaSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\WhosWhoBundle\Entity\Diploma');
    }

    public function it_has_no_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    public function it_has_no_name_by_default()
    {
        $this->getName()->shouldReturn(null);
    }

    public function its_name_is_mutable()
    {
        $this->setName('Ingénieur Civil');
        $this->getName()->shouldReturn('Ingénieur Civil');
    }

    public function it_has_no_specialty_by_default()
    {
        $this->getSpecialty()->shouldReturn(null);
    }

    public function it_has_no_institution_by_default()
    {
        $this->getInstitution()->shouldReturn(null);
    }

    public function its_institution_is_mutable()
    {
        $this->setInstitution('UCL');
        $this->getInstitution()->shouldReturn('UCL');
    }

    public function it_has_no_graduated_date_by_default()
    {
        $this->getGraduatedAt()->shouldReturn(null);
    }

    public function its_graduated_date_is_muttable()
    {
        $this->setGraduatedAt($date = new \DateTime('now'));
        $this->getGraduatedAt()->shouldReturn($date);
    }

    public function its_specialty_is_mutable()
    {
        $this->setSpecialty('MAP/MECA');
        $this->getSpecialty()->shouldReturn('MAP/MECA');
    }

    public function it_has_no_fra_by_default()
    {
        $this->getFra()->shouldReturn(null);
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Fra $fra
     */
    public function its_fra_is_muttable($fra)
    {
        $this->setFra($fra);
        $this->getFra()->shouldReturn($fra);
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Fra $fra
     */
    public function it_has_fluent_interface($fra)
    {
        $this->setName('Ingénieur Civil')->shouldReturn($this);
        $this->setSpecialty('MAP/MECA')->shouldReturn($this);
        $this->setInstitution('UCL')->shouldReturn($this);
        $this->setGraduatedAt(new \DateTime())->shouldReturn($this);
        $this->setFra($fra)->shouldReturn($this);
    }
}
