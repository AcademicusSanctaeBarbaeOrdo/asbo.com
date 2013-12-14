<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\EventBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Calendar choice form type.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
abstract class CalendarChoiceType extends AbstractType
{
    /**
     * Property class name.
     *
     * @var string
     */
    protected $className;

    /**
     * Constructor.
     *
     * @param string $className
     */
    public function __construct($className)
    {
        $this->className = $className;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(array(
                    'class' => $this->className
                ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'asbo_calendar_choice';
    }
}
