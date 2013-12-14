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
 * Default post types.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
final class PostTypes extends Types
{
    const COMITE = 'comite';
    const CONSEIL = 'conseil';
    const COMISSION = 'comission';
    const CAV = 'cav';
    const PONTIFES = 'pontifes';
    const FSB = 'fsb';

    /**
     * @return array The choices.
     */
    public static function getChoices()
    {
        return [
            self::COMITE => 'Comité',
            self::CONSEIL => 'Conseil',
            self::COMISSION => 'Comission',
            self::CAV => 'Comité des vétérans',
            self::PONTIFES => 'Pontifes',
            self::FSB => 'Fonds Sainte Barbe',
        ];
    }
}
