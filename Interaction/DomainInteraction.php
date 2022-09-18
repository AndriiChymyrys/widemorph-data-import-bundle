<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Interaction;

use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\ImportTypeFactoryInterface;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\ImportErrorCollectionInterface;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\EntityReflectionServiceInterface;

/**
 * Class DomainInteraction
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Interaction
 */
class DomainInteraction implements DomainInteractionInterface
{
    /**
     * @param EntityReflectionServiceInterface $entityReflectionService
     * @param ImportTypeFactoryInterface $importTypeFactory
     * @param ImportErrorCollectionInterface $importErrorCollection
     */
    public function __construct(
        protected EntityReflectionServiceInterface $entityReflectionService,
        protected ImportTypeFactoryInterface $importTypeFactory,
        protected ImportErrorCollectionInterface $importErrorCollection,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function getEntityReflectionService(): EntityReflectionServiceInterface
    {
        return $this->entityReflectionService;
    }

    /**
     * {@inheritDoc}
     */
    public function getImportTypeFactory(): ImportTypeFactoryInterface
    {
        return $this->importTypeFactory;
    }

    /**
     * {@inheritDoc}
     */
    public function getImportErrorCollection(): ImportErrorCollectionInterface
    {
        return $this->importErrorCollection;
    }
}
