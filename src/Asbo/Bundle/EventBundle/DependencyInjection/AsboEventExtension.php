<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\EventBundle\DependencyInjection;

use Sylius\Bundle\ResourceBundle\DependencyInjection\SyliusResourceExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Event system extension.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class AsboEventExtension extends SyliusResourceExtension
{
    protected $configFiles = array(
        'calendar',
        'event',
    );

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $this->configDir = __DIR__.'/../Resources/config';

        $this->configure(
            $configs,
            new Configuration($this->getAlias()),
            $container,
            self::CONFIGURE_LOADER | self::CONFIGURE_DATABASE | self::CONFIGURE_PARAMETERS | self::CONFIGURE_VALIDATORS
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function mapClassParameters(array $classes, ContainerBuilder $container)
    {
        foreach ($classes as $model => $serviceClasses) {
            foreach ($serviceClasses as $service => $class) {
                $container->setParameter(
                    sprintf('asbo.%s.%s.class', $service === 'form' ? 'form.type' : $service, $model),
                    $class
                );
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    protected function mapValidationGroupParameters(array $validationGroups, ContainerBuilder $container)
    {
        foreach ($validationGroups as $model => $groups) {
            $container->setParameter(sprintf('asbo.validation_group.%s', $model), $groups);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getAlias()
    {
        return 'asbo_event';
    }
}
