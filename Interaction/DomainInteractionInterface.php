<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Interaction;

use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\ImportTypeFactoryInterface;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\ImportErrorCollectionInterface;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\EntityReflectionServiceInterface;

/**
 * Class DomainInteractionInterface
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Interaction
 */
interface DomainInteractionInterface
{
    /**
     * @return EntityReflectionServiceInterface
     */
    public function getEntityReflectionService(): EntityReflectionServiceInterface;

    /**
     * @return ImportTypeFactoryInterface
     */
    public function getImportTypeFactory(): ImportTypeFactoryInterface;

    /**
     * @return ImportErrorCollectionInterface
     */
    public function getImportErrorCollection(): ImportErrorCollectionInterface;
}
