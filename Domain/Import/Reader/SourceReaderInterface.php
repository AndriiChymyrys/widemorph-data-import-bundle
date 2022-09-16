<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Reader;

use Generator;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\EntityReflectionInterface;

interface SourceReaderInterface
{
    public const SERVICE_TAG_NAME = 'morph.data-import.import.reader';

    public function readSource(array|UploadedFile $source, EntityReflectionInterface $entityReflection): Generator;

    public function support(array|UploadedFile $source, EntityReflectionInterface $entityReflection): bool;
}
