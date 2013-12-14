<?php

namespace Asbo\Bundle\MigrationBundle\Schema;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Asbo\Bundle\WhosWhoBundle\Model\Types\EmailTypes;

class Email extends AbstractSchema implements OrderedFixtureInterface
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
                'email',
                'type',
                'principal'
            ]
        );
    }

    protected function setNormalizers(OptionsResolverInterface $resolver)
    {
        $resolver->setNormalizers([
                'type' => function (Options $options, $value) {
                    switch ($value) {
                        case 0:
                            return EmailTypes::PRIVEE;
                        case 1:
                            return EmailTypes::BOULOT;
                    }

                    if (stristr($value, '@student.uclouvain.be')) {
                        return EmailTypes::UCL;
                    }

                    return EmailTypes::UNKNOWN;
                }
            ]
        );
    }

    protected function setAllowedValues(OptionsResolverInterface $resolver)
    {
        $resolver->setAllowedValues(
            [
                'type' => EmailTypes::getCallbackValidation()
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
