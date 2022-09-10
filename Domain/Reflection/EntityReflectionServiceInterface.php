<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection;

use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\EntityReflectionInterface;

interface EntityReflectionServiceInterface
{
    public function getEntitiesList(): array;

    public function getEntityReflection(string $entityName): EntityReflectionInterface;

    public function getEntitiesReflection(array $entities): EntityCollectionInterface;
}
