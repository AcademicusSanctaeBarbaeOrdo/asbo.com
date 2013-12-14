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

/**
 * Gallery fixture
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class Gallery extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Format the reference name of the given entity
     *
     * @param $entity \Asbo\Bundle\WhosWhoBundle\Entity\Fra
     * @return string
     */
    protected function formatReference($entity)
    {
        return 'asbo_gallery_'.$entity['id'];
    }

    /**
     * {@inheritdoc}
     */
    public function getSchemaClassName()
    {
        return 'Asbo\Bundle\MigrationBundle\Schema\Gallery';
    }

    protected function getEntity(array $data)
    {
        $entity = new \Asbo\Bundle\CoreBundle\Entity\Gallery();
        $entity->setName($data['name']);
        $entity->setCreatedAt($data['created_at']);
        $entity->setContext($data['context']);
        $entity->setDefaultFormat($data['default_format']);
        $entity->setEnabled($data['enabled']);
        $entity->setUpdatedAt($data['updated_at']);
        $entity->setDescription($data['description']);

        return $entity;
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
