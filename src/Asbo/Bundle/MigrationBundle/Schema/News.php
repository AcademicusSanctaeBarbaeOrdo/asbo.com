<?php

namespace Asbo\Bundle\MigrationBundle\Schema;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class News extends AbstractSchema implements OrderedFixtureInterface
{
    /**
     * {@inhertidoc}
     */
    protected function setSchema(OptionsResolverInterface $resolver)
    {
        $resolver->setRequired(
            [
                'id',
                'image_id',
                'author_id',
                'title',
                'abstract',
                'content',
                'raw_content',
                'content_formatter',
                'enabled',
                'slug',
                'publication_date_start',
                'comments_enabled',
                'comments_close_at',
                'comments_default_status',
                'created_at',
                'updated_at',
                'category_id',
                'comments_count',
            ]
        );

        $resolver->setOptional(
            [
                'number',
                'street'
            ]
        );
    }

    protected function setNormalizers(OptionsResolverInterface $resolver)
    {
        $resolver->setNormalizers([
                'enabled' => function (Options $options, $value) {
                        return (bool) $value;
                    },
                'comments_enabled' => function (Options $options, $value) {
                        return (bool) $value;
                    },
                'created_at' => function (Options $options, $value) {
                        return new \DateTime($value);
                    },
                'updated_at' => function (Options $options, $value) {
                        return new \DateTime($value);
                    },
                'publication_date_start' => function (Options $options, $value) {
                        return new \DateTime($value);
                    },
                'comments_close_at' => function (Options $options, $value) {
                        return new \DateTime($value);
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
        return 2;
    }
}
