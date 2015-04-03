<?php

namespace KD\Console\AliasBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('kd_console_alias');

        $rootNode
            ->children()
                ->scalarNode('base')
                    ->defaultValue('KD\\Console\\AliasBundle\\Service\\ConfigurableCommand')
                ->end()
                ->arrayNode('commands')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('name')
                                ->isRequired()
                                ->cannotBeEmpty()
                                ->info("Name that will be used to call the command")
                            ->end()
                            ->scalarNode('command')
                                ->isRequired()
                                ->cannotBeEmpty()
                                ->info("Executable to run")
                            ->end()
                            ->scalarNode('description')
                                ->info("Description for the command")
                            ->end()
                            ->booleanNode('console')
                                ->defaultFalse()
                                ->info("Mark this an alias to another symfony command")
                            ->end()
                            ->arrayNode('arguments')
                                ->prototype('scalar')
                               ->info("Arguments to be passed to the command")
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
