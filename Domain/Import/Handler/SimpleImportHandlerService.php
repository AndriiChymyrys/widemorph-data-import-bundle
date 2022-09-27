<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Handler;

use Generator;
use Doctrine\ORM\EntityManagerInterface;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\DTO\ImportForm\ImportFormDto;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\ImportEntityCollectionInterface;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\ImportEntityMethodServiceInterface;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\EntityReflectionInterface;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\ImportEntityRelationServiceInterface;

/**
 * Class SimpleImportHandlerService
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Handler
 */
class SimpleImportHandlerService implements ImportHandlerInterface
{
    /**
     * @param EntityManagerInterface $entityManager
     * @param ImportEntityCollectionInterface $entityCollection
     * @param ImportEntityRelationServiceInterface $entityRelationService
     * @param ImportEntityMethodServiceInterface $entityMethodService
     */
    public function __construct(
        protected EntityManagerInterface $entityManager,
        protected ImportEntityCollectionInterface $entityCollection,
        protected ImportEntityRelationServiceInterface $entityRelationService,
        protected ImportEntityMethodServiceInterface $entityMethodService,
    ) {
    }

    public function handle(
        Generator $generator,
        ImportFormDto $entityDto,
        EntityReflectionInterface $entityReflection
    ): void {
        foreach ($generator as $row) {
            foreach ($row as $fieldName => $value) {
                $entity = $this->entityCollection->getEntity($entityDto->getEntity(), $row);
                $method = $this->entityMethodService->getSetMethodName($fieldName, $entity);

                if ($method) {
                    $entity->{$method}($value);
                }
            }

            if (isset($row['relations'], $entity)) {
                $this->entityRelationService->importRelations(
                    $entity,
                    $entityReflection,
                    $entityDto->getEntity()->getRelations(),
                    $row['relations']
                );
            }
        }

        $this->entityManager->flush();
    }
}
