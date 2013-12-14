<?php

namespace Asbo\Bundle\MigrationBundle\Schema;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FraHasImage extends AbstractSchema implements OrderedFixtureInterface
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
                'path',
                'principal'
            ]
        );
    }

    protected function setNormalizers(OptionsResolverInterface $resolver)
    {
        $resolver->setNormalizers(
            [
                'principal' => function (Options $options, $value) {
                        return (bool) $value;
                    }
            ]
        );
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 3;
    }
}
