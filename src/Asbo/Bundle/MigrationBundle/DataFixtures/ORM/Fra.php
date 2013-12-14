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
 * Fra fixture
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class Fra extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Format the reference name of the given entity
     *
     * @param $entity \Asbo\Bundle\WhosWhoBundle\Entity\Fra
     * @return string
     */
    protected function formatReference($entity)
    {
        return 'asbo_whoswho_fra_'.$entity['id'];
    }

    /**
     * {@inheritdoc}
     */
    public function getSchemaClassName()
    {
        return 'Asbo\Bundle\MigrationBundle\Schema\Fra';
    }

    /**
     * {@inhertidoc}
     */
    public function getEntity(array $data)
    {
        $entity = new \Asbo\Bundle\WhosWhoBundle\Entity\Fra;

        $entity->setFirstname($data['prenom']);
        $entity->setLastName($data['nom']);
        $entity->setNickName($data['surnom']);
        $entity->setGender($data['sexe']);
        $entity->setBirthday($data['daten']   );
        $entity->setBirthplace($data['lieun']);
        $entity->setDeathday($data['datem']);
        $entity->setDeathplace($data['lieum']);
        $entity->setType($data['type']);
        $entity->setStatus($data['status']);
        $entity->setAnno($data['anno']);
        $entity->setPontif($data['pontif']);
        $entity->setSettings($this->getSettings());

        if ($this->hasReference('user_'.$data['uid'])) {
            $user = $this->getReference('user_'.$data['uid']);
            $user->addRole('ROLE_WHOSWHO_USER');
            $fraHasUser = new \Asbo\Bundle\WhosWhoBundle\Entity\FraHasUser();
            $fraHasUser->setUser($user);
            $fraHasUser->setOwner(true);
            $entity->addFraHasUser($fraHasUser);
        }

        return $entity;
    }

    public function getSettings()
    {
        $settings = new \Asbo\Bundle\WhosWhoBundle\Entity\Settings();
        $settings->setConvocBanquet(true);
        $settings->setConvocEphemeridesQ1(true);
        $settings->setConvocEphemeridesQ2(true);
        $settings->setConvocExterne(true);
        $settings->setConvocWe(true);
        $settings->setPereat(true);
        $settings->setWhoswho(true);

        return $settings;
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 1;
    }
}
