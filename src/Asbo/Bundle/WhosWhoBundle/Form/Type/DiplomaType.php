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

use Asbo\Bundle\WhosWhoBundle\Form\DataTransformer\DateRangeViewTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Diploma form type.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class DiplomaType extends AbstractType
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
     * @param string $class The Diploma class name.
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
        $years = range(1987, (int) (new \DateTime())->format('Y'));

        $graduatedAt = $builder
            ->create('graduatedAt', 'choice',
                [
                    'choices' => array_combine($years, $years),
                    'required' => false,
                ]
            )
            ->addModelTransformer(new DateRangeViewTransformer(new OptionsResolver()))
        ;

        $builder
            ->add('name')
            ->add('specialty')
            ->add('institution')
            ->add($graduatedAt)
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
        return 'asbo_whoswho_diploma';
    }
}
