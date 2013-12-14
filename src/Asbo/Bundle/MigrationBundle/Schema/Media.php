<?php

namespace Asbo\Bundle\MigrationBundle\Schema;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class Media extends AbstractSchema implements OrderedFixtureInterface
{
    /**
     * {@inhertidoc}
     */
    protected function setSchema(OptionsResolverInterface $resolver)
    {
        $resolver->setRequired(
            [
                'id',
                'name',
                'description',
                'enabled',
                'provider_name',
                'provider_status',
                'provider_reference',
                'provider_metadata',
                'width',
                'height',
                'length',
                'created_at',
                'content_type',
                'content_size',
                'copyright',
                'author_name',
                'context',
                'cdn_is_flushable',
                'cdn_flush_at',
                'updated_at',
                'nbrclics'
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
                'cdn_flush_at' => function (Options $options, $value) {
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
        return 4;
    }
}
