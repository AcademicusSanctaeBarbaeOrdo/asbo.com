<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\EventBundle;

use Asbo\Bundle\EventBundle\DependencyInjection\AsboEventExtension;
use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Sylius\Bundle\ResourceBundle\DependencyInjection\Compiler\ResolveDoctrineTargetEntitiesPass;
use Sylius\Bundle\ResourceBundle\SyliusResourceBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Event system
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class AsboEventBundle extends Bundle
{
    /**
     * Return array with currently supported drivers.
     *
     * @return array
     */
    public static function getSupportedDrivers()
    {
        return array(
            SyliusResourceBundle::DRIVER_DOCTRINE_ORM
        );
    }

    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        $interfaces = array(
            'Asbo\Bundle\EventBundle\Model\CalendarInterface' => 'asbo.model.calendar.class',
            'Asbo\Bundle\EventBundle\Model\EventInterface' => 'asbo.model.event.class',
        );

        $container->addCompilerPass(
            new ResolveDoctrineTargetEntitiesPass('asbo_event', $interfaces)
        );

        $mappings = array(
            sprintf('%s/Resources/config/doctrine/model', $this->getPath()) => 'Asbo\Bundle\EventBundle\Model',
        );

        $container->addCompilerPass(
            DoctrineOrmMappingsPass::createXmlMappingDriver(
                $mappings,
                array('doctrine.orm.entity_manager'),
                'asbo_event.driver.doctrine/orm'
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getContainerExtension()
    {
        return new AsboEventExtension();
    }
}
