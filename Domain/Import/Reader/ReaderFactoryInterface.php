<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Reader;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\EntityReflectionInterface;

interface ReaderFactoryInterface
{
    public function getReader(
        array|UploadedFile $source,
        EntityReflectionInterface $entityReflection
    ): SourceReaderInterface;
}
