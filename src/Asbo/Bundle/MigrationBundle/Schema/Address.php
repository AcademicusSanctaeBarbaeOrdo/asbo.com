<?php

namespace Asbo\Bundle\MigrationBundle\Schema;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Asbo\Bundle\WhosWhoBundle\Model\Types\AddressTypes;

class Address extends AbstractSchema implements OrderedFixtureInterface
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
                'genre',
                'adresse',
                'codepostal',
                'ville',
                'etat',
                'pays',
                'principal'
            ]
        );

        $resolver->setOptional(
            [
                'number',
                'street'
            ]
        );
    }

    protected function setNormalizers(OptionsResolverInterface $resolver)
    {
        $resolver->setNormalizers([
                'number' => function (Options $options, $value) {

                    $explode = explode(',', $options['adresse']);

                    $nb = $this->number($explode[0]);

                    if (null == $nb) {
                        return null;
                    }

                    return substr($options['adresse'], $nb, strpos($options['adresse'], ',')-$nb);
                },
                'adresse' => function (Options $options, $value) {
                    return sprintf('%s, %s %s, %s', $value, $options['codepostal'], $options['ville'], $options['pays']);
                },
                'genre' => function (Options $options, $value) {
                    switch ($value) {
                        case 'Parents':
                            return AddressTypes::PARENTS;
                        case 'Privée':
                            return AddressTypes::HOME;
                        case 'Kot':
                            return AddressTypes::KOT;
                        case 'Boulot':
                            return AddressTypes::BOULOT;
                        default :
                            return AddressTypes::UNKNOWN;
                    }
                },
                'principal' => function (Options $options, $value) {
                    return (bool) $value;
                },
                'street' => function (Options $options, $value) {
                    $nb = $this->number($options['adresse']);

                    return substr($options['adresse'], 0, $nb);
                }
            ]
        );
    }

    protected function number($text)
    {
        preg_match('/\d/', $text, $m, PREG_OFFSET_CAPTURE);
        if (sizeof($m))
            return $m[0][1]; // 24 in your example

        // return anything you need for the case when there's no numbers in the string
        return null;
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
