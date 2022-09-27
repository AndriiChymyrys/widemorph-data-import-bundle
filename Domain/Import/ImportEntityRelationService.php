<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import;

use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\DTO\ImportForm\EntityImportFormDto;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\EntityReflectionInterface;

/**
 * Class ImportEntityRelationService
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import
 */
class ImportEntityRelationService implements ImportEntityRelationServiceInterface
{
    /**
     * @param ImportEntityCollectionInterface $entityCollection
     * @param ImportEntityMethodServiceInterface $entityMethodService
     */
    public function __construct(
        protected ImportEntityCollectionInterface $entityCollection,
        protected ImportEntityMethodServiceInterface $entityMethodService
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function importRelations(
        object $entity,
        EntityReflectionInterface $entityReflection,
        array $relations,
        array $relationsRow
    ): void {
        foreach ($entityReflection->getFields() as $name => $item) {
            if ($item instanceof EntityReflectionInterface) {
                $row = $relationsRow[$item->getNamespace()] ?? null;
                $relationForm = null;

                /** @var EntityImportFormDto $relation */
                foreach ($relations as $relation) {
                    if ($relation->getNamespace() === $item->getNamespace()) {
                        $relationForm = $relation;
                    }
                }

                if ($row && $relationForm) {
                    $relationEntity = $this->entityCollection->getEntity($relationForm, $row);

                    foreach ($row as $fieldName => $value) {
                        $method = $this->entityMethodService->getSetMethodName($fieldName, $relationEntity);
                        $relationEntity->{$method}($value);
                    }

                    $relationMethod = $this->entityMethodService->getRelationSetMethodName($name, $entity);
                    $entity->{$relationMethod}($relationEntity);

                    $this->importRelations($relationEntity, $item, $relations, $relationsRow);
                }
            }
        }
    }
}
