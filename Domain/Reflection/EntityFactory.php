<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection;

use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\EntityReflection;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\EntityReflectionInterface;

/**
 * Class EntityFactory
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection
 */
class EntityFactory implements EntityFactoryInterface
{
    /**
     * @param array $entitiesConfig
     */
    public function __construct(protected readonly array $entitiesConfig)
    {
    }

    /**
     * @return EntityCollectionInterface
     */
    public function getEntityCollection(): EntityCollectionInterface
    {
        return new EntityCollection();
    }

    /**
     * @param string $namespace
     *
     * @return EntityReflectionInterface
     */
    public function getEntityReflection(string $namespace): EntityReflectionInterface
    {
        $entityConfig = $this->entitiesConfig[$namespace] ?? [];

        return new EntityReflection($namespace, $entityConfig);
    }
}
