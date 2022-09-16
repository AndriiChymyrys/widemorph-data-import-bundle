<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Infrastructure\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Reader\ReaderFactory;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Reader\SourceReaderInterface;

/**
 * Class ImportReaderCompilerPass
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Infrastructure\DependencyInjection\Compiler
 */
class ImportReaderCompilerPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     *
     * @return void
     */
    public function process(ContainerBuilder $container)
    {
        $readerFactoryDefinition = $container->getDefinition(ReaderFactory::class);

        $readers = [];

        foreach ($container->findTaggedServiceIds(SourceReaderInterface::SERVICE_TAG_NAME) as $key => $attribute) {
            $readers[] = $container->getDefinition($key);
        }

        $readerFactoryDefinition->replaceArgument('$readers', $readers);
    }
}
