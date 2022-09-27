<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection;

use ReflectionClass;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\EntityReflectionInterface;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\Field\EntityFieldFactoryInterface;

/**
 * Class EntityReflectionService
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection
 */
class EntityReflectionService implements EntityReflectionServiceInterface
{
    /**
     * @param EntityFileManagerInterface $entityFileManager
     * @param EntityFactoryInterface $entityFactory
     * @param EntityFieldFactoryInterface $entityFieldFactory
     * @param array $excludedEntity
     * @param array $includeEntity
     */
    public function __construct(
        protected readonly EntityFileManagerInterface $entityFileManager,
        protected readonly EntityFactoryInterface $entityFactory,
        protected readonly EntityFieldFactoryInterface $entityFieldFactory,
        protected readonly array $excludedEntity,
        protected readonly array $includeEntity,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function getEntitiesList(): array
    {
        $entities = $this->entityFileManager->scanEntityFolder();
        $result = [];

        foreach ($entities as $entity) {
            $result[$this->entityFileManager->getEntityNameSpace($entity)] = $entity;
        }

        return $this->filterEntities($result);
    }

    /**
     * {@inheritDoc}
     */
    public function getEntityReflection(
        string $entityName,
        bool $isNamespace = false,
        EntityReflectionInterface $parentEntityReflection = null
    ): EntityReflectionInterface {
        $namespace = $isNamespace ? $entityName : $this->entityFileManager->getEntityNameSpace($entityName);

        $reflection = new ReflectionClass($namespace);

        $properties = $reflection->getProperties();
        $entityReflection = $this->entityFactory->getEntityReflection($namespace);

        foreach ($properties as $property) {
            $reflectionField = $this->entityFieldFactory->createEntityField($property);
            if ($reflectionField->isRelation()) {
                $relationNamespace = $reflectionField->getFieldAnnotation()->targetEntity;

                if (!$parentEntityReflection || $relationNamespace !== $parentEntityReflection->getNamespace()) {
                    $relationEntityReflection = $this->getEntityReflection($relationNamespace, true, $entityReflection);
                    $entityReflection->addField($reflectionField, $relationEntityReflection);
                }
            } else {
                $entityReflection->addField($reflectionField);
            }
        }

        return $entityReflection;
    }

    /**
     * @param array $entities
     *
     * @return array
     */
    protected function filterEntities(array $entities): array
    {
        $finalEntityList = $entities;

        if (!empty($this->includeEntity)) {
            $finalEntityList = array_intersect_key($entities, array_flip($this->includeEntity));
        }

        return array_diff_key($finalEntityList, array_flip($this->excludedEntity));
    }
}
