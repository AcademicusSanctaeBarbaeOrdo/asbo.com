<?php

namespace Asbo\Bundle\MigrationBundle\Schema;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class Diploma extends AbstractSchema implements OrderedFixtureInterface
{
    /**
     * {@inhertidoc}
     */
    protected function setSchema(OptionsResolverInterface $resolver)
    {
        $resolver->setRequired(

            [
                'id',
                'fra_id',
                'diplome',
                'specialite',
                'institution',
                'actuel',
                'annee'
            ]
        );
    }

    protected function setNormalizers(OptionsResolverInterface $resolver)
    {
        $resolver->setNormalizers([
                'actuel' => function (Options $options, $value) {
                    return (bool) $value;
                },
                'annee' => function (Options $options, $value) {
                    if ($options['actuel']) {
                        return null;
                    }

                    if (!empty($value)) {
                        return new \DateTime($value);
                    }

                    return null;
                }
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
