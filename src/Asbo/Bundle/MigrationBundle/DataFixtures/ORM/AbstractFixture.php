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

use Doctrine\Common\DataFixtures\AbstractFixture as BaseAbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class AbstractSchema
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
abstract class AbstractFixture extends BaseAbstractFixture implements FixtureInterface
{
    /**
     * @var array The set of entities
     */
    protected $entities = array();

    protected $data = array();

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $om)
    {
        foreach ($this->data as $values) {
            $entity = $this->getEntity($values);
            $array = ['entity' => $entity, 'data' => $values];
            $this->entities[] = $array;

            $om->persist($entity);
        }
        $om->flush();

        foreach ($this->entities as $entity) {

            $this->addReference($this->formatReference($entity['data']), $entity['entity']);
        }
    }

    /**
     * @param array $entities
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * Get the fully qualified schema class name
     *
     * @return string
     */
    abstract public function getSchemaClassName();

    /**
     * Get the reference name for the given entity
     *
     * @param $entity
     * @return string
     */
    abstract protected function formatReference($entity);

    abstract protected function getEntity(array $data);
}
