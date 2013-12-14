<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\MigrationBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Galery Has media fixture
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class GalleryHasMedia extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Format the reference name of the given entity
     *
     * @param $entity \Asbo\Bundle\WhosWhoBundle\Entity\Fra
     * @return string
     */
    protected function formatReference($entity)
    {
        return 'asbo_gallery_has_media_'.$entity['id'];
    }

    /**
     * {@inheritdoc}
     */
    public function getSchemaClassName()
    {
        return 'Asbo\Bundle\MigrationBundle\Schema\GalleryHasMedia';
    }

    protected function getEntity(array $data)
    {
        $media = $this->getReference('asbo_media_'.$data['media_id']);
        $gallery = $this->getReference('asbo_gallery_'.$data['gallery_id']);

        $entity = new \Asbo\Bundle\CoreBundle\Entity\GalleryHasMedia();
        $entity->setMedia($media);
        $entity->setGallery($gallery);
        $entity->setPosition($data['position']);
        $entity->setUpdatedAt($data['updated_at']);
        $entity->setCreatedAt($data['created_at']);
        $entity->setEnabled($data['enabled']);

        return $entity;
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
