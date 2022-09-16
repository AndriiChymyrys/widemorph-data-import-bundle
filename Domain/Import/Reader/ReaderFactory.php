<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Reader;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Exception\ImportReaderException;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\EntityReflectionInterface;

class ReaderFactory implements ReaderFactoryInterface
{
    /**
     * @param SourceReaderInterface[] $readers
     */
    public function __construct(protected array $readers)
    {
    }

    public function getReader(
        array|UploadedFile $source,
        EntityReflectionInterface $entityReflection
    ): SourceReaderInterface {
        foreach ($this->readers as $reader) {
            if ($reader->support($source, $entityReflection)) {
                return $reader;
            }
        }

        throw new ImportReaderException('Reader for source no found');
    }
}
