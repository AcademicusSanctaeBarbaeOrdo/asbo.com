<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\WhosWhoBundle\Calculator;

use Asbo\Bundle\WhosWhoBundle\Entity\Fra;
use Asbo\Bundle\WhosWhoBundle\Util\AnnoManipulator;

/**
 * Calculator wich calculate the number of deniers which the Fra owes.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class DenierCalculator implements CalculatorInterface
{
    /**
     * The first year from wich we calculate.
     *
     * @var int
     */
    protected $anno;

    /**
     * Constructor.
     *
     * @param int $anno First year from which we calculate the number of deniers which the Fra owes.
     */
    public function __construct($anno = null)
    {
        if (null === $anno) {
            $anno = AnnoManipulator::getCurrentAnno();
        }

        $this->anno = $anno;
    }

    /**
     * Calculates how much deniers a fra owes.
     *
     * @param Fra $fra The Fra entity.
     *
     * @return int The number of deniers wich the Fra owes.
     */
    public function calculate(Fra $fra)
    {
        // Nombre d'année depuis que le fra est à l'ASBO
        $total = $this->anno - $fra->getAnno();

        // Rajout des deniers en fonction des postes occupés
        foreach ($fra->getFraHasPosts() as $post) {
            $total += $post->getPost()->getDenier();
        }

        return $total;
    }
}
