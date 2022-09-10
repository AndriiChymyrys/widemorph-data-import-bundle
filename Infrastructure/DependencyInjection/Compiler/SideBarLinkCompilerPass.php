<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Infrastructure\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Interaction\MorphViewInteractionInterface;

/**
 * Class SideBarLinkCompilerPass
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Infrastructure\DependencyInjection\Compiler
 */
class SideBarLinkCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        if ($container->hasDefinition(MorphViewInteractionInterface::SIDE_BAR_LINK_SERVICE_NAME)) {
            $sideBarLink = $container->getDefinition(MorphViewInteractionInterface::SIDE_BAR_LINK_SERVICE_NAME);
            $sideBarLink->addMethodCall(
                'addLink',
                ['morph_data_import_morph_data_import_entities_list', 'Data Import', 1, false, 'System']
            );
        }
    }
}
