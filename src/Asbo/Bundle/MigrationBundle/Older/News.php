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
 * News fixture
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class News extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Format the reference name of the given entity
     *
     * @param $entity \Asbo\Bundle\WhosWhoBundle\Entity\Fra
     * @return string
     */
    protected function formatReference($entity)
    {
        return 'asbo_news_'.$entity['id'];
    }

    /**
     * {@inheritdoc}
     */
    public function getSchemaClassName()
    {
        return 'Asbo\Bundle\MigrationBundle\Schema\News';
    }

    protected function getEntity(array $data)
    {
        if ($this->hasReference('user_'.$data['author_id'])) {
            $user = $this->getReference('user_'.$data['author_id']);
        }

        $entity = new \Asbo\Bundle\CoreBundle\Entity\Post();
        $entity->setAbstract($data['abstract']);

        if (isset($user)) {
            $entity->setAuthor($user);
        }

        $entity->setRawContent($data['raw_content']);
        $entity->setTitle($data['title']);
        $entity->setContent($data['content']);
        $entity->setContentFormatter($data['content_formatter']);
        $entity->setEnabled($data['enabled']);
        $entity->setSlug($data['slug']);
        $entity->setPublicationDateStart($data['publication_date_start']);
        $entity->setCommentsEnabled($data['comments_enabled']);
        $entity->setCommentsCloseAt($data['comments_close_at']);
        $entity->setCommentsDefaultStatus($data['comments_default_status']);
        $entity->setCreatedAt($data['created_at']);
        $entity->setUpdatedAt($data['updated_at']);

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
