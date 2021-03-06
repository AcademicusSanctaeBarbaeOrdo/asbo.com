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
use Asbo\Bundle\WhosWhoBundle\Util\AnnoManipulator;
use Symfony\Component\OptionsResolver\Options;

/**
 * Anno form type.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class AnnoType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $choicesCallback = function (Options $options) {
            $annos = AnnoManipulator::getAnnos();

            return $options['inverse_choices'] ? array_reverse($annos, true) : $annos;
        };

        $resolver->setDefaults(
            [
                'inverse_choices' => true,
                'choices' => $choicesCallback,
            ]
        );

        $resolver->setAllowedValues(
            [
               'inverse_choices' => [
                   true,
                   false,
                   0,
                   1,
               ]
            ]
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'asbo_whoswho_anno';
    }

    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return 'choice';
    }
}
