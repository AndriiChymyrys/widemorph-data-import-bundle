<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import;

use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Exception\ImportHandlerException;

/**
 * Class ImportEntityMethodService
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import
 */
class ImportEntityMethodService implements ImportEntityMethodServiceInterface
{
    /**
     * {@inheritDoc}
     */
    public function getSetMethodName(string $fieldName, object $entity): ?string
    {
        $method = 'set' . ucfirst($fieldName);

        if (!method_exists($entity, $method)) {
            return null;
        }

        return $method;
    }

    /**
     * {@inheritDoc}
     */
    public function getRelationSetMethodName(string $fieldName, object $entity): string
    {
        $setMethod = 'set' . ucfirst($fieldName);
        $addMethod = 'add' . ucfirst($fieldName);

        $method = method_exists($entity, $setMethod) ? $setMethod : $addMethod;

        $method = rtrim($method, 's');

        if (!method_exists($entity, $method)) {
            throw new ImportHandlerException(
                sprintf('Methods "%s", "%s" not found in entity "%s"', $setMethod, $addMethod, get_class($entity))
            );
        }

        return $method;
    }
}
