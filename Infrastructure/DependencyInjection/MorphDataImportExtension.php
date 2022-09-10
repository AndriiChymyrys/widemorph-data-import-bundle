<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Infrastructure\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\EntityFactory;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\EntityReflectionService;

/**
 * Class MorphDataImportExtension
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Infrastructure\DependencyInjection
 */
class MorphDataImportExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../../Resources/config')
        );

        $loader->load('domain.xml');
        $loader->load('interaction.xml');
        $loader->load('presentation.xml');
        $loader->load('infrastructure.xml');

        $configuration = new Configuration();

        $config = $this->processConfiguration($configuration, $configs);

        $definition = $container->getDefinition(EntityReflectionService::class);
        $definition->replaceArgument('$excludedEntity', $config['exclude_entity']);
        $definition->replaceArgument('$includeEntity', $config['include_entity']);

        $definition = $container->getDefinition(EntityFactory::class);
        $definition->replaceArgument('$entitiesConfig', $config['entities']);
    }
}
