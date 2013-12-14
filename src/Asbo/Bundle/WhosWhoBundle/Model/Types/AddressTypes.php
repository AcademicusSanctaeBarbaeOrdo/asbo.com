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
 * Default address types.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
final class AddressTypes extends Types
{
    const HOME    = 'private';
    const KOT     = 'kot';
    const PARENTS = 'parents';
    const BOULOT  = 'job';
    const UNKNOWN = 'unknown';

    /**
     * @return array The choices.
     */
    public static function getChoices()
    {
        return [
            self::HOME => 'Privée',
            self::KOT => 'Kot',
            self::PARENTS => 'Parents',
            self::BOULOT => 'Boulot',
            self::UNKNOWN => 'Inconnu',
        ];
    }
}
