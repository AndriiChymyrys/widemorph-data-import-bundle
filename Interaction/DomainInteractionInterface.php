<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Interaction;

use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\EntityReflectionServiceInterface;

interface DomainInteractionInterface
{
    /**
     * @return EntityReflectionServiceInterface
     */
    public function getEntityReflectionService(): EntityReflectionServiceInterface;
}
