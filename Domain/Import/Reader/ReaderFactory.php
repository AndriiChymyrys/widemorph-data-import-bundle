<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Reader;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Exception\ImportReaderException;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\EntityReflectionInterface;

/**
 * Class ReaderFactory
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Reader
 */
class ReaderFactory implements ReaderFactoryInterface
{
    /**
     * @param SourceReaderInterface[] $readers
     */
    public function __construct(protected array $readers)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function getReader(
        array|UploadedFile $source,
        EntityReflectionInterface $entityReflection
    ): SourceReaderInterface {
        $this->sort();

        foreach ($this->readers as $reader) {
            if ($reader->support($source, $entityReflection)) {
                return $reader;
            }
        }

        throw new ImportReaderException('Reader for source no found');
    }

    /**
     * @return void
     */
    protected function sort(): void
    {
        uasort($this->readers, static function (SourceReaderInterface $a, SourceReaderInterface $b) {
            if ($a->getPriority() === $b->getPriority()) {
                return 0;
            }

            return ($a->getPriority() < $b->getPriority()) ? -1 : 1;
        });
    }
}
