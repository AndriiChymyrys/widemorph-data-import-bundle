<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Infrastructure\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Handler\SimpleImportHandlerService;

/**
 * Class Configuration
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Infrastructure\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('morph_data_import');

        $treeBuilder->getRootNode()
            ->children()
                ->arrayNode('exclude_entity')
                    ->info('Exclude entity from import.')
                    ->scalarPrototype()->end()
                ->end()
                ->arrayNode('include_entity')
                    ->info('Include entity in import. If empty all entities will be included except entities form exclude_entity list')
                    ->scalarPrototype()->end()
                ->end()
                ->arrayNode('entities')
                    ->useAttributeAsKey('name')
                    ->arrayPrototype()
                        ->children()
                            ->arrayNode('exclude_properties')
                                ->info('Define not available entity fields for import.')
                                ->scalarPrototype()->end()
                            ->end()
                            ->scalarNode('handler')
                                ->info('Define import handler for entity.')
                                ->defaultValue(SimpleImportHandlerService::class)
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
