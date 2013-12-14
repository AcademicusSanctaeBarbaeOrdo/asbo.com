<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\WhosWhoBundle\Form\EventListener;

use Asbo\Bundle\WhosWhoBundle\Entity\Fra;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Form event listener that set principal resource to parent.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class PrincipalResourceListener implements EventSubscriberInterface
{
    /**
     * The resource name.
     *
     * @var string
     */
    protected $resource;

    /**
     * The event dispatcher.
     *
     * @var EventDispatcherInterface
     */
    protected $dispatcher = null;

    /**
     * Constructor.
     *
     * @param string                   $resource
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct($resource, EventDispatcherInterface $dispatcher)
    {
        $this->resource = $resource;
        $this->dispatcher = $dispatcher;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::PRE_SET_DATA => 'preSetData',
        ];
    }

    /**
     * @param FormEvent $event
     */
    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
            return;
        }

        $principal = $this->getPrincipal($data->getFra());

        if ($data == $principal) {
            $form->add('principal', 'checkbox',
                [
                    'mapped' => false,
                    'data' => true,
                    'required' => false,
                ]
            );

            $event->getDispatcher()->addListener(FormEvents::PRE_SUBMIT, [$this, 'preSubmitHasPrincipal']);
        } else {
            $mapped = empty($principal) ? true : false;
            $form->add('principal', 'checkbox',
                [
                    'mapped' => false,
                    'data' => $mapped,
                    'required' => false,
                ]
            );

            $event->getDispatcher()->addListener(FormEvents::PRE_SUBMIT, [$this, 'preSubmitHasNoPrincipal']);
        }
    }

    /**
     * @param FormEvent $event
     */
    public function preSubmitHasNoPrincipal(FormEvent $event)
    {
        $data = $event->getData();

        if (array_key_exists('principal', $data) && true == $data['principal']) {
            $event->getDispatcher()->addListener(FormEvents::POST_SUBMIT, [$this, 'postSubmitHasNoPrincipal']);
        }
    }

    /**
     * @param FormEvent $event
     */
    public function postSubmitHasNoPrincipal(FormEvent $event)
    {
        $data = $event->getData();
        $this->setPrincipal($data->getFra(), $data);
    }

    /**
     * @param FormEvent $event
     */
    public function preSubmitHasPrincipal(FormEvent $event)
    {
        $data = $event->getData();

        if (!array_key_exists('principal', $data) || false == $data['principal']) {
            $event->getDispatcher()->addListener(FormEvents::POST_SUBMIT, [$this, 'postSubmitHasPrincipal']);
        }
    }

    /**
     * @param FormEvent $event
     */
    public function postSubmitHasPrincipal(FormEvent $event)
    {
        $data = $event->getData();
        $this->setPrincipal($data->getFra(), null);
    }

    /**
     * @param $fra
     *
     * @return mixed
     */
    private function getPrincipal(Fra $fra)
    {
        return $fra->{'getPrincipal'.ucfirst($this->resource)}();
    }

    /**
     * @param Fra $fra
     * @param $value
     */
    private function setPrincipal(Fra $fra, $value)
    {
        $fra->{'setPrincipal'.ucfirst($this->resource)}($value);
    }
}
