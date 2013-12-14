<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\CoreBundle\Twig;

/**
 * Extension to manipulate Anno.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class AnnoExtension extends \Twig_Extension
{
    /**
     * @var array
     */
    protected $romans = array('M'  => 1000,
                              'CM' => 900,
                              'D'  => 500,
                              'CD' => 400,
                              'C'  => 100,
                              'XC' => 90,
                              'L'  => 50,
                              'XL' => 40,
                              'X'  => 10,
                              'IX' => 9,
                              'V'  => 5,
                              'IV' => 4,
                              'I'  => 1,
                             );

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return array(
             'DateToAnno' => new \Twig_Filter_Method($this, 'dateToAnnoFilter'),
             'AnnoToDate' => new \Twig_Filter_Method($this, 'annoToDateFilter'),
        );
    }

    /**
     * Transform date to Anno
     *
     * @param int|string $integer Arabic date
     *
     * @return string
     */
    public function dateToAnnoFilter($integer)
    {
        if ($integer < 0) {
            throw new \InvalidArgumentException(sprintf('The value must bu positif or null. %s given', $integer));
        }

        $return = '';

        if (0 === $integer || null === $integer) {
            return $integer;
        }

        while ($integer > 0) {
            foreach ($this->romans as $rom => $arb) {
                if ($integer >= $arb) {
                    $integer -= $arb;
                    $return .= $rom;
                    break;
                }
            }
        }

        return $return;
    }

    /**
     * Transform Anno to a date
     *
     * @param string $roman Roman date
     *
     * @return int
     */
    public function annoToDateFilter($roman)
    {
        if (strpos($roman, '-') !== false) {
            throw new \InvalidArgumentException(sprintf('The value must be positive. %s given', $roman));
        }

        $result = 0;

        foreach ($this->romans as $key => $value) {
            while (strpos($roman, $key) === 0) {
                $result += $value;
                $roman = substr($roman, strlen($key));
            }
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'anno_extension';
    }
}
