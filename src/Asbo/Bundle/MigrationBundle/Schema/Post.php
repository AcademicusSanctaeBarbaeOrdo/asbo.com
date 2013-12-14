<?php

namespace Asbo\Bundle\MigrationBundle\Schema;

use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Asbo\Bundle\WhosWhoBundle\Model\Types\PostTypes;

class Post extends AbstractSchema
{
    /**
     * {@inhertidoc}
     */
    protected function setSchema(OptionsResolverInterface $resolver)
    {
        $resolver->setRequired(
            [
                'id',
                'function',
                'type',
                'deniers',
            ]
        );
    }

    protected function setNormalizers(OptionsResolverInterface $resolver)
    {
        $resolver->setNormalizers([
                'type' => function (Options $options, $value) {
                    switch ($value) {
                        case 'Comité':
                            return PostTypes::COMITE;
                        case 'Conseil':
                            return PostTypes::CONSEIL;
                        case 'Commission':
                            return PostTypes::COMISSION;
                        case 'Comité Vétérans':
                            return PostTypes::CAV;
                        case 'Pontifes':
                            return PostTypes::PONTIFES;
                        case 'Fondation Sainte Barbe':
                            return PostTypes::FSB;
                        default:
                            return $value;
                    }
                },
                'deniers' => function (Options $options, $value) {
                    return (int) $value;
                },
            ]
        );
    }

    protected function setAllowedValues(OptionsResolverInterface $resolver)
    {
        $resolver->setAllowedValues(
            [
                'type' => PostTypes::getCallbackValidation()
            ]
        );
    }

    protected function setAllowedTypes(OptionsResolverInterface $resolver)
    {
        $resolver->setAllowedTypes(
            [
                'deniers' => 'integer'
            ]
        );
    }
}
