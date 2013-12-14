<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\WhosWhoBundle\Form\Filter;

use Asbo\Bundle\WhosWhoBundle\Model\Status\FraStatus;
use Asbo\Bundle\WhosWhoBundle\Model\Types\FraTypes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Lexik\Bundle\FormFilterBundle\Filter\FilterOperands;

/**
 * Fra filter.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class FraFilterType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', 'filter_text',
                [
                    'condition_pattern' => FilterOperands::STRING_BOTH,
                ]
            )
            ->add('lastname', 'filter_text',
                [
                    'condition_pattern' => FilterOperands::STRING_BOTH,
                ]
            )
            ->add('nickname', 'filter_text',
                [
                    'condition_pattern' => FilterOperands::STRING_BOTH,
                ]
            )
            ->add('anno', 'filter_number',
                [
                    'condition_operator' => FilterOperands::OPERAND_SELECTOR,
                ]
            )
            ->add('gender', 'filter_choice',
                [
                    'choices' => [
                        'm' => 'Mâle',
                        'f' => 'Sexe faible',
                    ]
                ]
            )
            ->add('type', 'filter_choice',
                [
                    'choices' => FraTypes::getChoices(),
                ]
            )
            ->add('status', 'filter_choice',
                [
                    'choices' => FraStatus::getChoices(),
                ]
            )
        ;

        $builder->add('fraHasPosts', new FraHasPostsFilterType());
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            [
                'csrf_protection'   => false,
                'validation_groups' => ['filtering'],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'fra_filter_type';
    }
}
