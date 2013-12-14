<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\WhosWhoBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

/**
 * String to anno transformer.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class StringToAnnoTransformer implements DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($date)
    {
        if ($date instanceof \DateTime) {
            $options = [
                'type' => 1,
                'date' => $date->format('Y'),
            ];
        } else {
            $options = [
                'type' => 0,
                'date' => $date,
            ];
        }

        return $options;
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($anno)
    {
        if ($anno['type'] == 1) {
            // Fix bug quand la date est juste 2002 par exemple il transforme en 20h02 et pas en l'année.
            // Pour modifier ce comportement on fixe la date au premier janvier
            $date = new \Datetime($anno['date'].'-01-01');
        } else {
            $date = (int) $anno['date'];
        }

        return $date;
    }
}
