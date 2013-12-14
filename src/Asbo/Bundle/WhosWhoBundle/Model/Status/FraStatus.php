<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\WhosWhoBundle\Model\Status;

use Asbo\Bundle\WhosWhoBundle\Validator\CallbackValidatorInterface;

/**
 * Default fra status.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
final class FraStatus implements CallbackValidatorInterface
{
    const IN_SPE      = 'in_spe';
    const TYRO        = 'tyro';
    const CANDIDATUS  = 'candidatus';
    const CHEVALIER   = 'chevalier';
    const XHANTIPPE   = 'xhantippe';
    const SODALES     = 'sodales';
    const VETERANUS   = 'veteranus';
    const CAPPELANUS  = 'cappelanus';
    const VEXILLARIUS = 'vexillarius';

    /**
     * @return array The choices.
     */
    public static function getChoices()
    {
        return [
            self::IN_SPE      => 'Membre In Spé',
            self::TYRO        => 'Tyro',
            self::CANDIDATUS  => 'Candidatus',
            self::CHEVALIER   => 'Chevalier',
            self::XHANTIPPE   => 'Xhantippe',
            self::SODALES     => 'Sodales',
            self::VETERANUS   => 'Veteranus',
            self::CAPPELANUS  => 'Cappelanus',
            self::VEXILLARIUS => 'Vexillarius',
        ];
    }

    /**
     * Returns an array with authorized keys.
     *
     * @return array The authorized keys.
     */
    final public static function getCallbackValidation()
    {
        return array_keys(static::getChoices());
    }

    /**
     * Returns true if the keys are in the authorized choices.
     *
     * @param $key
     * @return bool
     */
    final public static function isValid($key)
    {
        return array_key_exists($key, static::getChoices());
    }
}
