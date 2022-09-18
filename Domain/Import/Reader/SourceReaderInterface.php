<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Reader;

use Generator;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\DTO\ImportForm\ImportFormDto;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\EntityReflectionInterface;

/**
 * Class SourceReaderInterface
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Reader
 */
interface SourceReaderInterface
{
    /** @var string */
    public const SERVICE_TAG_NAME = 'morph.data-import.import.reader';

    /**
     * @param array|UploadedFile $source
     * @param ImportFormDto $entityDto
     * @param EntityReflectionInterface $entityReflection
     *
     * @return Generator
     */
    public function readSource(
        array|UploadedFile $source,
        ImportFormDto $entityDto,
        EntityReflectionInterface $entityReflection
    ): Generator;

    /**
     * @param array|UploadedFile $source
     * @param EntityReflectionInterface $entityReflection
     *
     * @return bool
     */
    public function support(array|UploadedFile $source, EntityReflectionInterface $entityReflection): bool;

    /**
     * @return int
     */
    public function getPriority(): int;
}
