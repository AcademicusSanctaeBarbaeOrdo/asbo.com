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
use Sonata\MediaBundle\Provider\MediaProviderInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Media fixture
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class Media extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        return 'asbo_media_'.$entity['id'];
    }

    /**
     * {@inheritdoc}
     */
    public function getSchemaClassName()
    {
        return 'Asbo\Bundle\MigrationBundle\Schema\Media';
    }

    protected function getEntity(array $data)
    {
        $entity = new \Asbo\Bundle\CoreBundle\Entity\Media();
        $entity->setName($data['name']);
        $entity->setDescription($data['description']);
        $entity->setEnabled($data['enabled']);
        $entity->setProviderName($data['provider_name']);
        $entity->setProviderStatus($data['provider_status']);
        $entity->setProviderReference($data['provider_reference']);
        $entity->setProviderMetadata(unserialize($data['provider_metadata']));
        $entity->setWidth($data['width']);
        $entity->setHeight($data['height']);
        $entity->setLength($data['length']);
        $entity->setCreatedAt($data['created_at']);
        $entity->setUpdatedAt($data['updated_at']);
        $entity->setContentType($data['content_type']);
        $entity->setSize($data['content_size']);
        $entity->setCopyright($data['copyright']);
        $entity->setAuthorName($data['author_name']);
        $entity->setContext($data['context']);
        $entity->setCdnIsFlushable((bool) $data['cdn_is_flushable']);
        $entity->setCdnFlushAt($data['cdn_flush_at']);

        $filename = __DIR__."/../../../../../../../old.asbo/uploads/".$data['provider_reference'];

        if (file_exists($filename)) {
            $entity->setBinaryContent($filename);
        }

        return $entity;
    }

    /**
     * @return MediaProviderInterface
     */
    private function getProvider()
    {
        return $this->container->get('sonata.media.pool')->getProvider('sonata.media.provider.image');
    }

    /**
     * @return \Sonata\MediaBundle\Model\MediaManagerInterface
     */
    public function getMediaManager()
    {
        return $this->container->get('sonata.media.manager.media');
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
