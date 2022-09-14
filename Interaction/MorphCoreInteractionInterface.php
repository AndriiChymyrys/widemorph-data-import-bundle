<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Interaction;

use WideMorph\Morph\Bundle\MorphCoreBundle\Interaction\DomainInteractionInterface;

/**
 * Class MorphCoreInteractionInterface
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Interaction
 */
interface MorphCoreInteractionInterface
{
    /**
     * @return DomainInteractionInterface
     */
    public function getDomainInteraction(): DomainInteractionInterface;
}
