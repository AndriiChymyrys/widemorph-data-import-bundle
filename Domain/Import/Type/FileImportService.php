<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Type;

use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\DTO\ImportForm\ImportFormDto;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Reader\ReaderFactoryInterface;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Handler\ImportHandlerInterface;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\EntityReflectionServiceInterface;

class FileImportService extends AbstractImportService
{
    public function importEntity(ImportFormDto $entityDto): void
    {
        $entityReflection = $this->entityReflectionService->getEntityReflection(
            $entityDto->getEntity()->getNamespace(),
            true
        );

        $reader = $this->readerFactory->getReader($entityDto->getFile(), $entityReflection);

        $data = $reader->readSource(
            $entityDto->getFile(),
            $entityDto,
            $entityReflection,
        );

        $handler = $entityReflection->getImportHandler() ?? $this->importHandler;

        $handler->handle($data, $entityDto, $entityReflection);
    }
}
