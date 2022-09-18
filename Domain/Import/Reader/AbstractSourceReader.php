<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Reader;

abstract class AbstractSourceReader implements SourceReaderInterface
{
    /**
     * {@inheritDoc}
     */
    public function getPriority(): int
    {
        return 1;
    }
}
