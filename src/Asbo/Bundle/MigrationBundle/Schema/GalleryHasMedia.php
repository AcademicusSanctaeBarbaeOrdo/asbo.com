<?php

namespace Asbo\Bundle\MigrationBundle\Schema;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GalleryHasMedia extends AbstractSchema implements OrderedFixtureInterface
{
    /**
     * {@inhertidoc}
     */
    protected function setSchema(OptionsResolverInterface $resolver)
    {
        $resolver->setRequired(
            [
                'id',
                'media_id',
                'gallery_id',
                'position',
                'enabled',
                'updated_at',
                'created_at',
            ]
        );
    }

    protected function setNormalizers(OptionsResolverInterface $resolver)
    {
        $resolver->setNormalizers([
                'enabled' => function (Options $options, $value) {
                        return (bool) $value;
                    },
                'updated_at' => function (Options $options, $value) {
                        return new \DateTime($value);
                    },
                'created_at' => function (Options $options, $value) {
                        return new \DateTime($value);
                    },
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
        return 5;
    }
}
