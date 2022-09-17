<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Reader;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\EntityReflectionInterface;

/**
 * Class ReaderFactoryInterface
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Reader
 */
interface ReaderFactoryInterface
{
    /**
     * @param array|UploadedFile $source
     * @param EntityReflectionInterface $entityReflection
     *
     * @return SourceReaderInterface
     */
    public function getReader(
        array|UploadedFile $source,
        EntityReflectionInterface $entityReflection
    ): SourceReaderInterface;
}
