<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\WhosWhoBundle\Form\Validator;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Form date range validator.
 */
class DateRangeValidator implements EventSubscriberInterface
{
    /**
     * An array of allowed options.
     *
     * @var array
     */
    protected $options = array();

    /**
     * Constructor.
     *
     * @param OptionsResolverInterface $resolver
     * @param array                    $options
     */
    public function __construct(OptionsResolverInterface $resolver, array $options = [])
    {
        $this->setDefaultOptions($resolver);
        $this->options = $resolver->resolve($options);
    }

    /**
     * Sets the default options for this validator.
     *
     * @param OptionsResolverInterface $resolver The resolver for the options.
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
                'allow_end_in_past' => true,
                'allow_single_year' => true,
            ]
        );

        $resolver->setAllowedValues([
                'allow_end_in_past' => [true, false],
                'allow_single_year' => [true, false],
            ]
        );
    }

    /**
     * Validate the data.
     *
     * @param FormEvent $event
     */
    public function onPreSubmit(FormEvent $event)
    {
        $dateRange = $event->getData();

        if (null === $dateRange) {
            return;
        }

        $form = $event->getForm();
        $start = $dateRange['dateBegin'];
        $end = $dateRange['dateEnd'];

        if (null === $start || '' === $start) {
            $form->get('dateBegin')->addError(new FormError('You must set a begining date.'));

            return;
        }

        if (!$this->options['allow_single_year'] && (null === $end || '' === $end)) {
            $form->get('dateEnd')->addError(new FormError('You must set a end date.'));

            return;
        }

        if ($start > $end && $end !== null && $end !== '') {
            $form->addError(new FormError('The start year must be lower thant end year.'));
        }

        if (!$this->options['allow_single_year'] and ($start === $end)) {
            $form->addError(new FormError('The finish year must be greater than start year.'));
        }

        if (!$this->options['allow_end_in_past'] and ($end < date('Y'))) {
            $form->addError(new FormError('date_range.invalid.end_in_past'));
        }

    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::PRE_SUBMIT => 'onPreSubmit'
        ];
    }
}
