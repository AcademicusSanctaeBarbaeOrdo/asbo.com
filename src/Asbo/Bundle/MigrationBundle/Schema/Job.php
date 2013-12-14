<?php

namespace Asbo\Bundle\MigrationBundle\Schema;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class Job extends AbstractSchema implements OrderedFixtureInterface
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
                'societe',
                'secteur',
                'poste',
                'annee_entree',
                'annee_sortie',
                'actuel'
            ]
        );
    }

    protected function setNormalizers(OptionsResolverInterface $resolver)
    {
        $resolver->setNormalizers(
            [
                'annee_entree' => function (Options $options, $value) {

                    if (!empty($value)) {
                        return new \DateTime($value);
                    }

                    return null;
                },
                'annee_sortie' => function (Options $options, $value) {
                    if ($options['actuel']) {
                        return null;
                    }

                    if (!empty($value)) {
                        return new \DateTime($value);
                    }

                    return null;
                },
                'actuel' => function (Options $options, $value) {
                    return (bool) $value;
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
        return 3;
    }
}
