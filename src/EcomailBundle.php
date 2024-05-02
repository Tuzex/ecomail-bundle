<?php

declare(strict_types=1);

namespace Tuzex\Ecomail;

use Ecomail;
use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

final class EcomailBundle extends AbstractBundle
{
    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->rootNode()
            ->children()
            ->arrayNode('ecomail')
            ->children()
            ->arrayNode('api')
            ->children()
            ->scalarNode('key')->end()
            ->end()
            ->end()
            ->end() // twitter
            ->end();
    }

    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->services()
            ->get(Ecomail::class)
            ->arg(0, $config['ecomail']['api']['key'])
        ;
    }
}
