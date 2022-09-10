<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection;

use ReflectionClass;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\EntityReflectionInterface;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\Field\EntityFieldFactoryInterface;
use App\Entity\ImportPlan;

class EntityReflectionService implements EntityReflectionServiceInterface
{
    private const DEFAULT_EXCLUDE_ENTITY = [ImportPlan::class];

    public function __construct(
        protected readonly EntityFileManagerInterface $entityFileManager,
        protected readonly EntityFactoryInterface $entityFactory,
        protected readonly EntityFieldFactoryInterface $entityFieldFactory,
        protected readonly array $excludedEntity,
        protected readonly array $includeEntity,
    ) {
    }

    public function getEntitiesList(): array
    {
        $entities = $this->entityFileManager->scanEntityFolder();
        $result = [];

        foreach ($entities as $entity) {
            $result[$this->entityFileManager->getEntityNameSpace($entity)] = $entity;
        }

        return $this->filterEntities($result);
    }

    public function getEntityReflection(string $entityName): EntityReflectionInterface
    {
        $namespace = $this->entityFileManager->getEntityNameSpace($entityName);

        $reflection = new ReflectionClass($namespace);

        $properties = $reflection->getProperties();
        $entityReflection = $this->entityFactory->getEntityReflection($namespace);

        foreach ($properties as $property) {
            $entityReflection->addField($this->entityFieldFactory->createEntityField($property));
        }

        return $entityReflection;
    }

    public function getEntitiesReflection(array $entities): EntityCollectionInterface
    {
        $entityCollection = $this->entityFactory->getEntityCollection();

        foreach ($entities as $entity) {
            $entityCollection->add($this->getEntityReflection($entity));
        }

        return $entityCollection;
    }

    protected function filterEntities(array $entities): array
    {
        $finalEntityList = $entities;

        if (!empty($this->includeEntity)) {
            $finalEntityList = array_intersect_key($entities, array_flip($this->includeEntity));
        }

        $exclude = array_merge($this->excludedEntity, static::DEFAULT_EXCLUDE_ENTITY);

        return array_diff_key($finalEntityList, array_flip($exclude));
    }
}