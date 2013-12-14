<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\WhosWhoBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * AsboWhosWhoExtension.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @var string The alias of the bundle.
     */
    private $alias;

    /**
     * Constructor.
     *
     * @param string $alias
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
        $rootNode    = $treeBuilder->root($this->alias);

        $rootNode
            ->children()
                ->arrayNode('role')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('list')
                            ->isRequired()
                            ->cannotBeEmpty()
                            ->defaultValue('ROLE_WHOSWHO_USER')
                        ->end()
                        ->scalarNode('create')
                            ->isRequired()
                            ->cannotBeEmpty()
                            ->defaultValue('ROLE_WHOSWHO_CHANCELIER')
                        ->end()
                        ->scalarNode('edit')
                            ->isRequired()
                            ->cannotBeEmpty()
                            ->defaultValue('ROLE_WHOSWHO_FRA_MANAGE')
                        ->end()
                        ->scalarNode('delete')
                            ->isRequired()
                            ->cannotBeEmpty()
                            ->defaultValue('ROLE_WHOSWHO_CHANCELIER')
                        ->end()
                        ->scalarNode('view')
                            ->isRequired()
                            ->cannotBeEmpty()
                            ->defaultValue('ROLE_WHOSWHO_USER')
                        ->end()
                        ->scalarNode('export')
                            ->isRequired()
                            ->cannotBeEmpty()
                            ->defaultValue('ROLE_WHOSWHO_CHANCELIER')
                        ->end()
                    ->end()
                ->end()
                ->integerNode('nb_fra_last_login')
                    ->cannotBeEmpty()
                    ->defaultValue(10)
                ->end()
            ->end();

        return $treeBuilder;
    }
}
