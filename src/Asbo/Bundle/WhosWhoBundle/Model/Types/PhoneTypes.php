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
 * Default phone types.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
final class PhoneTypes extends Types
{
    const PRIVEE  = 'private';
    const BOULOT  = 'job';
    const PARENTS = 'parents';
    const KOT     = 'kot';
    const FAX     = 'Fax';
    const GSM     = 'GSM';
    const UNKNOWN = 'unknown';

    /**
     * @return array The choices.
     */
    public static function getChoices()
    {
        return [
            self::PRIVEE  => 'Privée',
            self::PARENTS => 'Parents',
            self::KOT     => 'Kot',
            self::BOULOT  => 'Boulot',
            self::FAX     => 'Fax',
            self::GSM     => 'GSM',
            self::UNKNOWN => 'Inconnu'
        ];
    }
}
