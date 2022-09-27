<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import;

use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\EntityReflectionInterface;

/**
 * Class ImportEntityRelationServiceInterface
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import
 */
interface ImportEntityRelationServiceInterface
{
    /**
     * @param object $entity
     * @param EntityReflectionInterface $entityReflection
     * @param array $relations
     * @param array $relationsRow
     *
     * @return void
     */
    public function importRelations(
        object $entity,
        EntityReflectionInterface $entityReflection,
        array $relations,
        array $relationsRow
    ): void;
}
