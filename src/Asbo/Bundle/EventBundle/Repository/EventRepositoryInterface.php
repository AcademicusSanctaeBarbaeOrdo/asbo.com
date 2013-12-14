<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\EventBundle\Repository;

use Asbo\Bundle\EventBundle\Model\EventInterface;
use Sylius\Bundle\ResourceBundle\Model\RepositoryInterface;

/**
 * Event repository interface.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
interface EventRepositoryInterface extends RepositoryInterface
{
    /**
     * Get upcoming active events.
     *
     * @param int $amount
     *
     * @return EventInterface[]
     */
    public function findUpcomingConfirmedEvents($amount = 5);

    /**
     * Get past active events.
     *
     * @param int $amount
     *
     * @return EventInterface[]
     */
    public function findPastConfirmedEvents($amount = 5);
}
