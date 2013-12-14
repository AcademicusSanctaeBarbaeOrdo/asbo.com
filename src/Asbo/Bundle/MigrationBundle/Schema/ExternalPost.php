<?php

namespace Asbo\Bundle\MigrationBundle\Schema;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ExternalPost extends AbstractSchema implements OrderedFixtureInterface
{
    /**
     * {@inhertidoc}
     */
    protected function setSchema(OptionsResolverInterface $resolver)
    {
        $resolver->setRequired(

            [
                'id',
                'poste',
                'cercle',
                'annee_debut',
                'annee_fin',
                'actuel',
                'fra_id'
            ]
        );
    }

    protected function setNormalizers(OptionsResolverInterface $resolver)
    {
        $resolver->setNormalizers([
                'actuel' => function (Options $options, $value) {
                    return (bool) $value;
                },
                'annee_debut' => function (Options $options, $value) {

                    if (!empty($value)) {
                        return new \DateTime($value);
                    }

                    return new \DateTime('01-01-1987');
                },
                'annee_fin' => function (Options $options, $value) {
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
