<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Reader;

use Generator;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\EntityReflectionInterface;

class ExcelSourceReader implements SourceReaderInterface
{
    public function readSource(array|UploadedFile $source, EntityReflectionInterface $entityReflection): Generator
    {
        yield ['one'];
    }

    public function support(array|UploadedFile $source, EntityReflectionInterface $entityReflection): bool
    {
        return $source instanceof UploadedFile;
    }
}
