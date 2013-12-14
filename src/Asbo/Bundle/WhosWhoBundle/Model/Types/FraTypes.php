<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Asbo\Bundle\WhosWhoBundle\Model\Types;

/**
 * Default fra types.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
final class FraTypes extends Types
{
    const IMPETRANT = 'impetrant';
    const IN_SPE = 'in_spe';
    const HONORIS_CAUSA = 'honoris_causa';
    const CHEVALIER = 'chevalier';

    /**
     * @return array The choices.
     */
    public static function getChoices()
    {
        return [
            self::IMPETRANT     => 'Membre Impétrant',
            self::IN_SPE        => 'Membre In Spé',
            self::HONORIS_CAUSA => 'Membre Honoris Causa',
            self::CHEVALIER     => 'Chevalier',
        ];
    }
}
