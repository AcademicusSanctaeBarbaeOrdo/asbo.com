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
class Preference extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Format the reference name of the given entity
     *
     * @param $entity \Asbo\Bundle\WhosWhoBundle\Entity\Fra
     * @return string
     */
    protected function formatReference($entity)
    {
        return 'asbo_whoswho_preference_'.$entity['id'];
    }

    /**
     * {@inheritdoc}
     */
    public function getSchemaClassName()
    {
        return 'Asbo\Bundle\MigrationBundle\Schema\Preference';
    }

    protected function getEntity(array $data)
    {
        /** @var \Asbo\Bundle\WhosWhoBundle\Entity\Fra $fra */
        $fra = $this->getReference('asbo_whoswho_fra_'.$data['fra_id']);

        $fra->setContributor((bool) $data['cotisant']);

        $settings = $fra->getSettings();
        $settings->setConvocBanquet($data['convoc_banquet']);
        $settings->setConvocEphemeridesQ1($data['convoc_ephemerides_q1']);
        $settings->setConvocEphemeridesQ2($data['convoc_ephemerides_q2']);
        $settings->setConvocExterne($data['convoc_externe']);
        $settings->setConvocWe($data['convoc_we']);
        $settings->setPereat($data['pereat']);
        $settings->setWhoswho($data['whoswho']);

        return $fra;
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
