<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\MigrationBundle\Schema;

use Asbo\Bundle\WhosWhoBundle\Model\Status\FraStatus;
use Asbo\Bundle\WhosWhoBundle\Model\Types\FraTypes;
use Asbo\Bundle\WhosWhoBundle\Util\AnnoManipulator;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Schema of fra
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class Fra extends AbstractSchema
{
    /**
     * {@inhertidoc}
     */
    protected function setSchema(OptionsResolverInterface $resolver)
    {
        $resolver->setRequired(
            [
                'id',
                'uid',
                'prenom',
                'nom',
                'surnom',
                'sexe',
                'daten',
                'datem',
                'lieun',
                'lieum',
                'type',
                'status',
                'anno',
                'pontif'
            ]
        );

        $resolver->setOptional(
            [
                'slug'
            ]
        );
    }

    protected function setNormalizers(OptionsResolverInterface $resolver)
    {
        $resolver->setNormalizers(
            [
                'sexe' => function (Options $options, $value) {

                        if (strtoupper($value) == 'F') {
                            return 'f';
                        }

                        return 'm';
                },
                'daten' => function (Options $options, $value) {

                    if ($value instanceof \DateTime) {
                        return $value;
                    }

                    if (!empty($value) && '0000-00-00' !== $value) {
                        return new \DateTime($value);
                    }

                    return null;
                },
                'datem' => function (Options $options, $value) {

                    if ($value instanceof \DateTime) {
                        return $value;
                    }

                    if (!empty($value) && '0000-00-00' !== $value) {
                        return new \DateTime($value);
                    }

                    return null;
                },
                'pontif' => function (Options $options, $value) {
                    return (bool) $value;
                },
                'type' => function (Options $options, $value) {

                    switch ($value) {
                        case 0:
                            return FraTypes::IMPETRANT;
                        case 1:
                            return FraTypes::IN_SPE;
                        case 2:
                            return FraTypes::HONORIS_CAUSA;
                        case 3:
                            return FraTypes::CHEVALIER;
                        default:
                            return (int) $value;
                    }
                },
                'status' => function (Options $options, $value) {
                    switch ($value) {
                        case 0:
                            return FraStatus::TYRO;
                        case 1:
                            return FraStatus::CHEVALIER;
                        case 2:
                            return FraStatus::CAPPELANUS;
                        case 3:
                            return FraStatus::CHEVALIER;
                        case 4:
                            return FraStatus::CANDIDATUS;
                        case 5:
                            return FraStatus::CHEVALIER;
                        case 6:
                            return FraStatus::XHANTIPPE;
                        case 7:
                            return FraStatus::SODALES;
                        case 8:
                            return FraStatus::VETERANUS;
                        case 9:
                            return FraStatus::IN_SPE;
                        default:
                            return (int) $value;
                    }
                },
                'anno' => function (Options $options, $value) {
                    return (int) $value;
                },
            ]
        );
    }

    protected function setAllowedTypes(OptionsResolverInterface $resolver)
    {
        $resolver->setAllowedTypes(
            [
                'type' => 'string',
                'status' => 'string',
                'anno' => 'integer',
            ]
        );
    }

    protected function setAllowedValues(OptionsResolverInterface $resolver)
    {
        $resolver->setAllowedValues(
            [
                'type' => array_keys(FraTypes::getChoices()),
                'status' => array_keys(FraStatus::getChoices()),
                'anno' => AnnoManipulator::getAnnos(),
                'pontif' => [false, true]
            ]
        );
    }
}
