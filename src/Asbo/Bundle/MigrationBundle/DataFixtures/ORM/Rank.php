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
 * Address fixture
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class Rank extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Format the reference name of the given entity
     *
     * @param $entity \Asbo\Bundle\WhosWhoBundle\Entity\Fra
     * @return string
     */
    protected function formatReference($entity)
    {
        return 'asbo_whoswho_rank_'.$entity['id'];
    }

    /**
     * {@inheritdoc}
     */
    public function getSchemaClassName()
    {
        return 'Asbo\Bundle\MigrationBundle\Schema\Rank';
    }

    protected function getEntity(array $data)
    {
        $fra = $this->getReference('asbo_whoswho_fra_'.$data['fra_id']);

        $entity = new \Asbo\Bundle\WhosWhoBundle\Entity\Rank();
        $entity->setFra($fra);
        $entity->setName($data['titre']);

        return $entity;
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
