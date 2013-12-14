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
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Asbo\Bundle\WhosWhoBundle\Form\DataTransformer\DateRangeViewTransformer;
use Asbo\Bundle\WhosWhoBundle\Form\Validator\DateRangeValidator;

/**
 * Date range form type.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class DateRangeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                $builder
                    ->create('dateBegin', 'choice',
                        [
                            'choices' => $options['range'],
                        ]
                    )
                    ->addModelTransformer($options['transformer'])
            )
            ->add(
                $builder
                    ->create('dateEnd', 'choice',
                        [
                            'choices' => $options['range'],
                            'required' => false,
                        ]
                    )
                    ->addModelTransformer($options['transformer'])
            )
        ;

        $builder->addEventSubscriber($options['validator']);
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $range = function (Options $options) {
            $years = range($options['start'], $options['end']);
            $years = array_combine($years, $years);

            return $options['inverse'] ? array_reverse($years, true) : $years;
        };

        $resolver->setDefaults(
            [
                'start' => date('Y') - 10,
                'end' => date('Y'),
                'range' => $range,
                'inverse' => true,
                'transformer' => null,
                'validator' => null,
            ]
        );

        $resolver->setAllowedTypes(
            [
                'start' => 'integer',
                'end' => 'integer',
                'transformer' => 'Symfony\Component\Form\DataTransformerInterface',
                'validator' => 'Symfony\Component\EventDispatcher\EventSubscriberInterface',
            ]
        );

        $resolver->setNormalizers(
            [
                'start' => function (Options $options, $value) {
                    return (int) $value;
                },
                'end' => function (Options $options, $value) {
                    return (int) $value;
                },
                'transformer' => function (Options $options, $value) {
                    if (!$value) {
                        $value = new DateRangeViewTransformer(new OptionsResolver());
                    }

                    return $value;
                },
                'validator' => function (Options $options, $value) {
                    if (!$value) {
                        $value = new DateRangeValidator(new OptionsResolver());
                    }

                    return $value;
                }
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'asbo_whoswho_date_range';
    }

}
