<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import;

use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\DTO\ImportForm\EntityImportFormDto;

/**
 * Class ImportEntityCollectionInterface
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import
 */
interface ImportEntityCollectionInterface
{
    /**
     * @param EntityImportFormDto $entityImportFormDto
     * @param array $row
     *
     * @return object
     */
    public function getEntity(EntityImportFormDto $entityImportFormDto, array $row): object;
}
