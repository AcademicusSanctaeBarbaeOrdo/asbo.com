<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\WhosWhoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Diploma form type.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class ExternalPostType extends AbstractType
{
    /**
     * Fully qualified class name.
     *
     * @var string
     */
    private $class;

    /**
     * Constructor.
     *
     * @param string $class The ExternalPost class name
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $options = [
            'virtual' => true,
            'data_class' => $this->class,
        ];

        $builder
            ->add('where')
            ->add('position')
            ->add('date', 'asbo_whoswho_date_range', $options)
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => $this->class,
            ]
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'asbo_whoswho_externalpost';
    }
}
