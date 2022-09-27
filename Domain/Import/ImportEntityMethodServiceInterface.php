<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import;

/**
 * Class ImportEntityMethodServiceInterface
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import
 */
interface ImportEntityMethodServiceInterface
{
    /**
     * @param string $fieldName
     * @param object $entity
     *
     * @return string|null
     */
    public function getSetMethodName(string $fieldName, object $entity): ?string;

    /**
     * @param string $fieldName
     * @param object $entity
     *
     * @return string
     */
    public function getRelationSetMethodName(string $fieldName, object $entity): string;
}
