<?php

namespace KD\Console\AliasBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Definition;

class KDConsoleAliasExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $class = $config['base'];

        foreach ($config['commands'] as $key => $properties) {
            $command = new Definition($class, array($properties, $properties['name']));
            $command->addTag('console.command');

            $container->setDefinition($key, $command);
        }
    }
}
