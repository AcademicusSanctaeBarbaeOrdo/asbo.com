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

use Symfony\Component\Validator\Constraint;

/**
 * Metadata for the AnnoValidator.
 *
 * @Annotation
 */
class Anno extends Constraint
{
    /**
     * {@inheritDoc}
     */
    public $message = "The anno '{{ anno }}' doens't exist.";
}
