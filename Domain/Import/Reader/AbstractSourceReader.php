<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Reader;

use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\DTO\ImportForm\ImportFormDto;

/**
 * Class AbstractSourceReader
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Reader
 */
abstract class AbstractSourceReader implements SourceReaderInterface
{
    /**
     * {@inheritDoc}
     */
    public function getPriority(): int
    {
        return 1;
    }

    /**
     * @param ImportFormDto $entityDto
     *
     * @return void
     */
    protected function normalizeFieldIntValues(ImportFormDto $entityDto): void
    {
        $fnNormalize = static function (array $fields) {
            foreach ($fields as $key => $value) {
                $fields[$key] = (int)$value;
            }

            return $fields;
        };

        $entityDto->getEntity()->setFields($fnNormalize($entityDto->getEntity()->getFields()));

        foreach ($entityDto->getEntity()->getRelations() as $relation) {
            $relation->setFields($fnNormalize($relation->getFields()));
        }
    }
}
