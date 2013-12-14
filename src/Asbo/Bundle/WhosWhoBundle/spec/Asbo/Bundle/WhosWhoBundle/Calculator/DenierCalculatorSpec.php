<?php

namespace spec\Asbo\Bundle\WhosWhoBundle\Calculator;

use Asbo\Bundle\WhosWhoBundle\Entity\Fra;
use Asbo\Bundle\WhosWhoBundle\Entity\FraHasPost;
use Asbo\Bundle\WhosWhoBundle\Entity\Post;
use PhpSpec\ObjectBehavior;

class DenierCalculatorSpec extends ObjectBehavior
{
    private $anno;

    public function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\WhosWhoBundle\Calculator\DenierCalculator');
    }

    public function it_implements_Asbo_whoswho_calculator_interface()
    {
        $this->shouldImplement('Asbo\Bundle\WhosWhoBundle\Calculator\CalculatorInterface');
    }

    public function let()
    {
        $this->beConstructedWith($anno = rand(0, 100));

        $this->anno = $anno;
    }

    /**
     * @param \Asbo\Bundle\WhosWhoBundle\Entity\Fra $fra
     */
    public function it_calculates_how_much_money_a_fra_owes($fra)
    {
        $fra->getAnno()->willReturn($annoFra = rand(0, $this->anno - 1));

        $fra->getFraHasPosts()->willReturn(
            [
                $this->createFraHasPost(2),
                $this->createFraHasPost(3),
                $this->createFraHasPost(4)
            ]
        );

        $this->calculate($fra)->shouldReturn($this->anno - $annoFra + 9);
    }

    private function createFraHasPost($denier)
    {
        $fraHasPost = new FraHasPost();
        $fraHasPost->setPost($this->createPost($denier));

        return $fraHasPost;
    }

    private function createPost($dernier)
    {
        $post = new Post();
        $post->setDenier($dernier);

        return $post;
    }
}
