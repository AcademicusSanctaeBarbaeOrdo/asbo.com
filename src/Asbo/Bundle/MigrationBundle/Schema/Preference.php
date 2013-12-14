<?php

namespace Asbo\Bundle\MigrationBundle\Schema;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class Preference extends AbstractSchema
{
    /**
     * {@inhertidoc}
     */
    protected function setSchema(OptionsResolverInterface $resolver)
    {
        $resolver->setRequired(
            [
                'id',
                'fra_id',
                'cotisant',
                'whoswho',
                'pereat',
                'convoc_externe',
                'convoc_banquet',
                'convoc_we',
                'convoc_ephemerides_q1',
                'convoc_ephemerides_q2'
            ]
        );
    }

    protected function setNormalizers(OptionsResolverInterface $resolver)
    {
    }

    protected function setAllowedValues(OptionsResolverInterface $resolver)
    {

    }

    protected function setAllowedTypes(OptionsResolverInterface $resolver)
    {

    }
}
