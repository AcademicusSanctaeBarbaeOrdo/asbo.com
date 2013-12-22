<?php

namespace spec\Asbo\Bundle\CoreBundle\EventListener;

use PhpSpec\ObjectBehavior;

class LogoutListenerSpec extends ObjectBehavior
{
    protected $session;

    public function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\CoreBundle\EventListener\LogoutListener');
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Session\Session        $session
     * @param \Symfony\Component\HttpFoundation\Session\Flash\FlashBag $bag
     */
    public function let($session, $bag)
    {
        $this->beConstructedWith($session);
        $session->getFlashBag()->willReturn($bag);
        $this->session = $session;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Session\Flash\FlashBag             $bag
     * @param \Symfony\Component\HttpFoundation\Response                           $response
     * @param \Symfony\Component\HttpFoundation\Request                            $request
     * @param \Symfony\Component\Security\Core\Authentication\Token\TokenInterface $token
     * @param \Asbo\Bundle\CoreBundle\Entity\User                                  $user
     */
    public function it_create_success_message_when_logout($bag, $response, $request, $token, $user)
    {
        $bag->add('success', 'Au revoir Malian !')->shouldBeCalled();

        $token->getUser()->willReturn($user);
        $user->getFullname()->willReturn('Malian');
        $this->logout($request, $response, $token);
    }
}
