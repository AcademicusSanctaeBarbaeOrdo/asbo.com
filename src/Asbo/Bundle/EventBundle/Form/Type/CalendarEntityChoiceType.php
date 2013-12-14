<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\EventBundle\Form\Type;

/**
 * Calendar entity choice form type.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class CalendarEntityChoiceType extends CalendarChoiceType
{
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'entity';
    }
}
