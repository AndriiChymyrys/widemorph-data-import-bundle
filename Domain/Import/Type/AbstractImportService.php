<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Type;

use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\DTO\ImportForm\ImportFormDto;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Reader\SourceReaderInterface;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Reader\ReaderFactoryInterface;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Handler\ImportHandlerInterface;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\ImportErrorCollectionInterface;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Exception\ImportErrorValidationException;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\EntityReflectionServiceInterface;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\EntityReflectionInterface;

/**
 * Class AbstractImportService
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Type
 */
abstract class AbstractImportService implements ImportTypeServiceInterface
{
    /**
     * @param EntityReflectionServiceInterface $entityReflectionService
     * @param ReaderFactoryInterface $readerFactory
     * @param ImportHandlerInterface $importHandler
     * @param ImportErrorCollectionInterface $importErrorCollection
     */
    public function __construct(
        protected EntityReflectionServiceInterface $entityReflectionService,
        protected ReaderFactoryInterface $readerFactory,
        protected ImportHandlerInterface $importHandler,
        protected ImportErrorCollectionInterface $importErrorCollection,
    ) {
    }

    /**
     * @param ImportFormDto $entityDto
     * @param EntityReflectionInterface $entityReflection
     * @param SourceReaderInterface $reader
     * @param ImportHandlerInterface $handler
     *
     * @return void
     */
    abstract public function import(
        ImportFormDto $entityDto,
        EntityReflectionInterface $entityReflection,
        SourceReaderInterface $reader,
        ImportHandlerInterface $handler
    ): void;

    /**
     * @param ImportFormDto $entityDto
     *
     * @return void
     */
    public function importEntity(ImportFormDto $entityDto): void
    {
        $entityReflection = $this->entityReflectionService->getEntityReflection(
            $entityDto->getEntity()->getNamespace(),
            true
        );

        $reader = $this->readerFactory->getReader($entityDto->getFile(), $entityReflection);
        $handler = $entityReflection->getImportHandler() ?? $this->importHandler;

        try {
            $this->import($entityDto, $entityReflection, $reader, $handler);
        } catch (ImportErrorValidationException $errorException) {
            $this->importErrorCollection->addError($errorException->getMessage());
        }
    }
}
