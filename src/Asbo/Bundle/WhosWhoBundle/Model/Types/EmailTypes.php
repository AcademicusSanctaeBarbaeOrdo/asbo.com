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
 * Default email types.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
final class EmailTypes extends Types
{
    const PRIVEE  = 'private';
    const BOULOT  = 'job';
    const UCL     = 'ucl';
    const UNKNOWN = 'unknown';

    /**
     * @return array The choices.
     */
    public static function getChoices()
    {
        return [
            self::PRIVEE => 'Privée',
            self::BOULOT => 'Boulot',
            self::UCL => 'UCL',
            self::UNKNOWN => 'Inconnu',
        ];
    }
}
