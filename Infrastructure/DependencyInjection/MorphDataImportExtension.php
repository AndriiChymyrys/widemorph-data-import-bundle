<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Infrastructure\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\EntityFactory;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\EntityReflectionService;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Reader\SourceReaderInterface;

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
            new FileLocator(__DIR__ . '/../../Resources/config')
        );

        foreach (['domain.xml', 'interaction.xml', 'presentation.xml', 'infrastructure.xml'] as $file) {
            $loader->load($file);
        }

        $this->handleConfiguration($configs, $container);

        $container->registerForAutoconfiguration(SourceReaderInterface::class)
            ->addTag(SourceReaderInterface::SERVICE_TAG_NAME);
    }

    /**
     * @param array $configs
     * @param ContainerBuilder $container
     *
     * @return void
     */
    protected function handleConfiguration(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();

        $config = $this->processConfiguration($configuration, $configs);

        $definition = $container->getDefinition(EntityReflectionService::class);
        $definition->replaceArgument('$excludedEntity', $config['exclude_entity']);
        $definition->replaceArgument('$includeEntity', $config['include_entity']);

        $definition = $container->getDefinition(EntityFactory::class);

        $entitiesConfig = [];

        foreach ($config['entities'] as $key => $entity) {
            $entity['handler'] = $container->getDefinition($entity['handler']);
            $entitiesConfig[$key] = $entity;
        }

        $definition->replaceArgument('$entitiesConfig', $entitiesConfig);
    }
}
