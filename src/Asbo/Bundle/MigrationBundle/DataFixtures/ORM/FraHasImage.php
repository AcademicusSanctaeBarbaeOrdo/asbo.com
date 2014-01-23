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
 * Address fixture
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class FraHasImage extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        return 'asbo_whoswho_fra_has_image_'.$entity['id'];
    }

    /**
     * {@inheritdoc}
     */
    public function getSchemaClassName()
    {
        return 'Asbo\Bundle\MigrationBundle\Schema\FraHasImage';
    }

    protected function getEntity(array $data)
    {
        $fra = $this->getReference('asbo_whoswho_fra_'.$data['fra_id']);

        $entity = new \Asbo\Bundle\WhosWhoBundle\Entity\FraHasImage();
        $entity->setFra($fra);
        $entity->setAnno($this->getAnno($fra));
        $entity->setImage($image = $this->getImage($data));
        $fra->setPrincipalImage($entity);

        return $entity;
    }

    private function getAnno($fra)
    {
        return $fra->getAnno();
    }

    private function getImage($data)
    {
        $image = new \Asbo\Bundle\CoreBundle\Entity\Media();
        $image->setContext('whoswho');
        $image->setProviderName('sonata.media.provider.image');
        $image->setEnabled(true);

        $filename = __DIR__."/../../../../../../old/whoswho/".$data['fra_id'].'/'.$data['path'];

        $image->setBinaryContent($filename);

        return $image;
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
