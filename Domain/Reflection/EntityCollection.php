<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection;

use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\EntityReflectionInterface;

/**
 * Class EntityCollection
 *
 * This cals needed in case if we need to handle many entities at one like handle relations between entities
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection
 */
class EntityCollection implements EntityCollectionInterface
{
    /**
     * @var EntityReflectionInterface[]
     */
    protected array $entities;

    /**
     * {@inheritDoc}
     */
    public function add(EntityReflectionInterface $entityReflection): void
    {
        $this->entities[$entityReflection->getNamespace()] = $entityReflection;
    }

    /**
     * {@inheritDoc}
     */
    public function getFirst(): EntityReflectionInterface
    {
        return $this->entities[array_key_first($this->entities)];
    }
}
