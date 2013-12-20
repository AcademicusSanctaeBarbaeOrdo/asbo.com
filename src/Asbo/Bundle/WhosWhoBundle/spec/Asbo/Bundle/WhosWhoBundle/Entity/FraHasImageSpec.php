<?php

namespace spec\Asbo\Bundle\WhosWhoBundle\Entity;

use PhpSpec\ObjectBehavior;

class FraHasImageSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\WhosWhoBundle\Entity\FraHasImage');
    }

    public function it_has_no_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    public function it_has_no_anno_by_default()
    {
        $this->getAnno()->shouldReturn(null);
    }

    public function its_anno_is_mutable()
    {
        $this->setAnno(24);
        $this->getAnno()->shouldReturn(24);
    }

    public function it_has_no_image_by_default()
    {
        $this->getImage()->shouldReturn(null);
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Model\FraImageInterface $image
     */
    public function its_image_is_muttable($image)
    {
        $this->setImage($image);
        $this->getImage()->shouldReturn($image);
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
     * @param \Asbo\Bundle\WhosWhoBundle\Model\FraImageInterface $image
     */
    public function it_is_convertable_to_string_and_returns_image_id($image)
    {
        $image->getId()->shouldBeCalled();
        $image->getId()->willReturn(1);

        $this->setImage($image);
        $this->__toString()->shouldReturn('Image: #1');
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Fra $fra
     *  @param \Asbo\Bundle\WhosWhoBundle\Model\FraImageInterface $image
     */
    public function it_has_fluent_interface($fra, $image)
    {
        $this->setFra($fra)->shouldReturn($this);
        $this->setImage($image)->shouldReturn($this);
        $this->setAnno(24)->shouldReturn($this);
    }
}
