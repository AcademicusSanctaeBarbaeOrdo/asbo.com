<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Asbo\Bundle\WhosWhoBundle\Validator;

/**
 * Class Types
 */
interface CallbackValidatorInterface
{
    /**
     * @return array The choices.
     */
    public static function getChoices();

    /**
     * @return array The authorized keys.
     */
    public static function getCallbackValidation();
}
