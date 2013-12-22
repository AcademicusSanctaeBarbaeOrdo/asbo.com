<?php

namespace spec\Asbo\Bundle\CoreBundle\EventListener;

use PhpSpec\ObjectBehavior;

class LoginListenerSpec extends ObjectBehavior
{
    protected $context;

    public function it_is_initializable()
    {
        $this->shouldHaveType('Asbo\Bundle\CoreBundle\EventListener\LoginListener');
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Session\Session         $session
     * @param \Symfony\Component\Security\Core\SecurityContextInterface $context
     * @param \Symfony\Component\HttpFoundation\Session\Flash\FlashBag  $bag
     */
    public function let($session, $context, $bag)
    {
        $this->beConstructedWith($session, $context);

        $session->getFlashBag()->willReturn($bag);

        $this->context = $context;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Session\Flash\FlashBag             $bag
     * @param \Symfony\Component\Security\Http\Event\InteractiveLoginEvent         $event
     * @param \Symfony\Component\Security\Core\Authentication\Token\TokenInterface $token
     * @param \Asbo\Bundle\CoreBundle\Entity\User                                  $user
     */
    public function it_create_message_when_login($bag, $event, $token, $user)
    {
        $this->context->isGranted('IS_AUTHENTICATED_FULLY')->shouldBeCalled();
        $this->context->isGranted('IS_AUTHENTICATED_FULLY')->willReturn(true);
        $bag->add('success', 'Bonjour Malian !')->shouldBeCalled();
        $event->getAuthenticationToken()->willReturn($token);
        $event->getAuthenticationToken()->shouldBeCalled();
        $token->getUser()->willReturn($user);
        $token->getUser()->shouldBeCalled();
        $user->getFullname()->shouldBeCalled();
        $user->getFullname()->willReturn('Malian');

        $this->onLogin($event);
    }

}
