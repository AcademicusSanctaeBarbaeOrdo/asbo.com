<?php

namespace Asbo\Bundle\MigrationBundle\Schema;

use Asbo\Bundle\WhosWhoBundle\Util\AnnoManipulator;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FraHasPost extends AbstractSchema implements OrderedFixtureInterface
{
    /**
     * {@inhertidoc}
     */
    protected function setSchema(OptionsResolverInterface $resolver)
    {
        $resolver->setRequired(
            [
                'id',
                'postelist_id',
                'fra_id',
                'anno'
            ]
        );
    }

    protected function setNormalizers(OptionsResolverInterface $resolver)
    {
        $resolver->setNormalizers([
                'anno' => function (Options $options, $value) {
                    $anno = AnnoManipulator::getAnnos();

                    if ($value > end($anno)) {
                        return new \DateTime($value.'-01-01');
                    }

                    return (int) $value;
                },
            ]
        );
    }

    protected function setAllowedTypes(OptionsResolverInterface $resolver)
    {
        $resolver->setAllowedTypes(
            [
                'anno' => ['DateTime', 'integer']
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
