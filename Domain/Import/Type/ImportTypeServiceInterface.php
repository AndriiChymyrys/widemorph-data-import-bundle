<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Type;

use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\DTO\ImportForm\ImportFormDto;

/**
 * Class ImportTypeServiceInterface
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Type
 */
interface ImportTypeServiceInterface
{
    /**
     * @param ImportFormDto $entityDto
     *
     * @return void
     */
    public function importEntity(ImportFormDto $entityDto): void;
}
