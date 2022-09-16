<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Infrastructure\DependencyInjection\MorphDataImportExtension;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Infrastructure\DependencyInjection\Compiler\SideBarLinkCompilerPass;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Infrastructure\DependencyInjection\Compiler\ImportReaderCompilerPass;

/**
 * Class MorphDataImportBundle
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle
 */
class MorphDataImportBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function build(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new SideBarLinkCompilerPass());
        $container->addCompilerPass(new ImportReaderCompilerPass());
    }

    /**
     * {@inheritDoc}
     */
    public function getContainerExtension(): ?ExtensionInterface
    {
        return new MorphDataImportExtension();
    }
}
