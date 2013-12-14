<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\QuizzBundle\Model;

/**
 * Default quizz types.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
final class QuizzTypes
{
    const OPTIONAL = 'optional';
    const REQUIRED = 'required';

    /**
     * @return array The choices.
     */
    public static function getChoices()
    {
        return array(
            self::OPTIONAL => 'Optionnel',
            self::REQUIRED => 'Obligatoire'
        );
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
