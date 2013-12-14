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

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Form event listener that add some fields to the form.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class EditFraListener implements EventSubscriberInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::POST_SET_DATA => 'postSetData',
        ];
    }

    /**
     * Adds proper fields form before setting the fra.
     *
     * @param FormEvent $event
     */
    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data || null === $data->getId()) {
            return;
        }

        $closure = function (EntityRepository $er) use ($data) {

            $qb = $er
                ->createQueryBuilder('resource')
                ->where('resource.fra = :fra')
                ->setParameter('fra', $data)
            ;

            return $qb;
        };

        $form->add('principalAddress', null,
            [
                'query_builder' => $closure,
                'empty_value' => false,
            ]
        );

        $form->add('principalPhone', null,
            [
                'query_builder' => $closure,
                'empty_value' => false,
            ]
        );

        $form->add('principalEmail', null,
            [
                'query_builder' => $closure,
                'empty_value' => false,
            ]
        );
    }

    /**
     * Removes proper fields form after setting the fra.
     *
     * @param FormEvent $event
     */
    public function postSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data || null === $data->getId()) {
            return;
        }

        if ($data->getAddresses()->isEmpty()) {
            $form->remove('principalAddress');
        }

        if ($data->getPhones()->isEmpty()) {
            $form->remove('principalPhone');
        }

        if ($data->getEmails()->isEmpty()) {
            $form->remove('principalEmail');
        }
    }
}
