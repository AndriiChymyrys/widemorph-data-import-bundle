<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Type;

use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Reader\ReaderFactoryInterface;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Handler\ImportHandlerInterface;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\EntityReflectionServiceInterface;

abstract class AbstractImportService implements ImportTypeServiceInterface
{
    public function __construct(
        protected EntityReflectionServiceInterface $entityReflectionService,
        protected ReaderFactoryInterface $readerFactory,
        protected ImportHandlerInterface $importHandler,
    ) {
    }
}
