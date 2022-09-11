<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection;

use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\EntityReflectionInterface;

/**
 * Class EntityReflectionServiceInterface
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection
 */
interface EntityReflectionServiceInterface
{
    /**
     * @return array
     */
    public function getEntitiesList(): array;

    /**
     * @param string $entityName
     *
     * @return EntityReflectionInterface
     */
    public function getEntityReflection(string $entityName): EntityReflectionInterface;

    /**
     * @param array $entities
     *
     * @return EntityCollectionInterface
     */
    public function getEntitiesReflection(array $entities): EntityCollectionInterface;
}
