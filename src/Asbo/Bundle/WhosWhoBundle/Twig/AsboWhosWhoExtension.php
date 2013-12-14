<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\WhosWhoBundle\Twig;

use Asbo\Bundle\WhosWhoBundle\Calculator\DenierCalculator;
use Asbo\Bundle\WhosWhoBundle\Entity\Fra;
use Asbo\Bundle\WhosWhoBundle\Util\AnnoManipulator;
use Twig_Extension;
use Twig_SimpleFunction;

/**
 * Asbo who's who extension for Twig spec.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class AsboWhosWhoExtension extends Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        $functions =  [
            new Twig_SimpleFunction('asbo_calculate_denier', [$this, 'calculateDenierFromFraAndAnno']),
            new Twig_SimpleFunction('asbo_current_anno', [$this, 'getCurrentAnno']),
        ];

        return $functions;
    }

    /**
     * Calculates how much deniers a fra owes.
     *
     * @param Fra $fra  The fra entity.
     * @param int $anno First year from which we calculate the number of deniers which the Fra owes.
     *
     * @return int
     */
    public function calculateDenierFromFraAndAnno(Fra $fra, $anno)
    {
        $calculator = new DenierCalculator($anno);

        return $calculator->calculate($fra);
    }

    /**
     * Returns the current anno.
     *
     * @return integer The current anno.
     */
    public function getCurrentAnno()
    {
        $anno = AnnoManipulator::getCurrentAnno();

        return $anno;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'asbo_whoswho';
    }
}
