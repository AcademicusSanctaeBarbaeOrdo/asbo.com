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

use Asbo\Bundle\WhosWhoBundle\Entity\Fra;
use Asbo\Bundle\WhosWhoBundle\Model\Types\FraTypes;
use Asbo\Bundle\WhosWhoBundle\Model\Status\FraStatus;
use Symfony\Component\Validator\ExecutionContextInterface;

/**
 * Match status and type validator.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class StatusTypeValidator
{
    protected static $correspondenceMatrix = [
        FraTypes::IN_SPE => [
            FraStatus::IN_SPE      => 1,
            FraStatus::TYRO        => 1,
            FraStatus::CANDIDATUS  => 1,
            FraStatus::CHEVALIER   => 1,
            FraStatus::XHANTIPPE   => 1,
            FraStatus::SODALES     => 1,
            FraStatus::VETERANUS   => 1,
            FraStatus::CAPPELANUS  => 1,
            FraStatus::VEXILLARIUS => 1,
        ],
        FraTypes::IMPETRANT => [
            FraStatus::IN_SPE      => 0,
            FraStatus::TYRO        => 1,
            FraStatus::CANDIDATUS  => 1,
            FraStatus::CHEVALIER   => 0,
            FraStatus::XHANTIPPE   => 0,
            FraStatus::SODALES     => 0,
            FraStatus::VETERANUS   => 0,
            FraStatus::CAPPELANUS  => 0,
            FraStatus::VEXILLARIUS => 0,
        ],
        FraTypes::CHEVALIER => [
            FraStatus::IN_SPE      => 0,
            FraStatus::TYRO        => 0,
            FraStatus::CANDIDATUS  => 0,
            FraStatus::CHEVALIER   => 1,
            FraStatus::XHANTIPPE   => 1,
            FraStatus::SODALES     => 1,
            FraStatus::VETERANUS   => 1,
            FraStatus::CAPPELANUS  => 1,
            FraStatus::VEXILLARIUS => 1,
        ],
        FraTypes::HONORIS_CAUSA => [
            FraStatus::IN_SPE      => 0,
            FraStatus::TYRO        => 0,
            FraStatus::CANDIDATUS  => 0,
            FraStatus::CHEVALIER   => 1,
            FraStatus::XHANTIPPE   => 1,
            FraStatus::SODALES     => 1,
            FraStatus::VETERANUS   => 1,
            FraStatus::CAPPELANUS  => 1,
            FraStatus::VEXILLARIUS => 1,
        ],
    ];

    /**
     * Valid the correspondance between fra and status.
     *
     * @param  Fra                       $fra
     * @param  ExecutionContextInterface $context
     * @return bool
     * @todo: Je trouve ça pas très propre.
     */
    public static function isValid(Fra $fra, ExecutionContextInterface $context)
    {
        $type = $fra->getType();
        $status = $fra->getStatus();

        if (!FraTypes::isValid($type)) {
            $context->addViolationAt(
                'type', sprintf('The type "%s" doens\'t exists.', $type)
            );

            return false;
        }

        if (!FraStatus::isValid($status)) {
            $context->addViolationAt(
                'status', sprintf('The status "%s" doens\'t exists.', $status)
            );

            return false;
        }

        if (!array_key_exists($status, static::$correspondenceMatrix[$type])) {
            $context->addViolationAt(
                'status', sprintf('The status "%s" isn\'t compatible with the type "%s".', $status, $type)
            );

            return false;
        }

        return true;
    }
}
