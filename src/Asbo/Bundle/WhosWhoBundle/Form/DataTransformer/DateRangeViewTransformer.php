<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\WhosWhoBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use DateTime;

/**
 * DateTime to year transformer.
 */
class DateRangeViewTransformer implements DataTransformerInterface
{
    /**
     * @var array An array of allowed options.
     */
    protected $options = [];

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
     * @param OptionsResolverInterface $resolver
     */
    protected function setDefaultOptions(OptionsResolverInterface $resolver)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function transform($value)
    {
        if (!$value) {
            return null;
        }

        if (!$value instanceof DateTime) {
            throw new UnexpectedTypeException($value, 'DateTime');
        }

        return (int) $value->format('Y');
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($value)
    {
        if (!$value) {
            return null;
        }

        $date = new DateTime();
        $date->setDate($value, 1, 1);
        $date->setTime(0, 0, 0);

        return $date;
    }
}
