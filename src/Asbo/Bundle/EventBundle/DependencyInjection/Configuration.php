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

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This class contains the configuration information for the bundle.
 *
 * This information is solely responsible for how the different configuration
 * sections are normalized, and merged.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @var string The alias of the bundle
     */
    private $alias;

    /*
     * Constructor.
     */
    public function __construct($alias)
    {
        $this->alias = $alias;
    }

    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root($this->alias);

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('driver')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
            ->end()
        ;

        $this->addValidationGroupsSection($rootNode);
        $this->addClassesSection($rootNode);

        return $treeBuilder;
    }

    /**
     * Adds `validation_groups` section.
     *
     * @param ArrayNodeDefinition $node
     */
    private function addValidationGroupsSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('validation_groups')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('calendar')
                            ->prototype('scalar')->end()
                                ->defaultValue(array('asbo'))
                        ->end()
                        ->arrayNode('event')
                            ->prototype('scalar')->end()
                            ->defaultValue(array('asbo'))
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }

    /**
     * Adds `classes` section.
     *
     * @param ArrayNodeDefinition $node
     */
    private function addClassesSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('classes')
                ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('calendar')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')
                                    ->defaultValue('Asbo\\Bundle\\EventBundle\\Model\\Calendar')
                                ->end()
                                ->scalarNode('controller')
                                    ->defaultValue('Asbo\\Bundle\\EventBundle\\Controller\\CalendarController')
                                ->end()
                                ->scalarNode('repository')
                                    ->defaultValue('Asbo\\Bundle\\EventBundle\\Doctrine\\ORM\\EventRepository')
                                ->end()
                                ->scalarNode('form')
                                    ->defaultValue('Asbo\\Bundle\\EventBundle\\Form\\Type\\CalendarType')
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('event')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')
                                    ->defaultValue('Asbo\\Bundle\\EventBundle\\Model\\Event')
                                ->end()
                                ->scalarNode('controller')
                                    ->defaultValue('Asbo\\Bundle\\EventBundle\\Controller\\EventController')
                                ->end()
                                ->scalarNode('repository')
                                    ->defaultValue('Asbo\\Bundle\\EventBundle\\Doctrine\\ORM\\EventRepository')
                                ->end()
                                ->scalarNode('form')
                                    ->defaultValue('Asbo\\Bundle\\EventBundle\\Form\\Type\\EventType')
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
