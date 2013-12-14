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

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Doctrine\ORM\QueryBuilder;

use Lexik\Bundle\FormFilterBundle\Filter\FilterBuilderExecuterInterface;
use Lexik\Bundle\FormFilterBundle\Filter\Extension\Type\FilterTypeSharedableInterface;
use Lexik\Bundle\FormFilterBundle\Filter\FilterOperands;

/**
 * Embed filter for fra filter.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class FraHasPostsFilterType extends AbstractType implements FilterTypeSharedableInterface
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('anno', 'filter_number',
                [
                    'condition_operator' => FilterOperands::OPERAND_SELECTOR,
                ]
            )
            ->add('post', 'filter_entity',
                [
                    'class' => 'Asbo\Bundle\WhosWhoBundle\Entity\Post',
                    'property' => 'name',
                    'expanded' => false,
                    'multiple' => true,
                ]
            );
    }

    /**
     * {@inheritdoc}
     */
    public function addShared(FilterBuilderExecuterInterface $qbe)
    {
        $closure = function (QueryBuilder $filterBuilder, $alias) {
            $filterBuilder->leftJoin($alias . '.fraHasPosts', 'fraHasPost');
        };

        $qbe->addOnce($qbe->getAlias().'.fraHasPosts', 'fraHasPost', $closure);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'fra_has_posts_filter';
    }
}
