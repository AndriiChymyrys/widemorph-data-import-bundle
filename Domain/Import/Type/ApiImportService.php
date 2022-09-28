<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Type;

use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\DTO\ImportForm\ImportFormDto;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Reader\SourceReaderInterface;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Handler\ImportHandlerInterface;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\EntityReflectionInterface;

/**
 * Class ApiImportService
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Type
 */
class ApiImportService extends AbstractImportService
{
    /**
     * {@inheritDoc}
     */
    public function import(
        ImportFormDto $entityDto,
        EntityReflectionInterface $entityReflection,
        SourceReaderInterface $reader,
        ImportHandlerInterface $handler
    ): void {
        // TODO: Implement import() method.
    }
}
