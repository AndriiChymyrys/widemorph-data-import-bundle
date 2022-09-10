<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Interaction;

use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\EntityReflectionServiceInterface;

class DomainInteraction implements DomainInteractionInterface
{
    public function __construct(protected EntityReflectionServiceInterface $entityReflectionService)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function getEntityReflectionService(): EntityReflectionServiceInterface
    {
        return $this->entityReflectionService;
    }
}
