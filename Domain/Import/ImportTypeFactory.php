<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import;

use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\DTO\ImportForm\ImportFormDto;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Type\ImportTypeServiceInterface;

/**
 * Class ImportTypeFactory
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import
 */
class ImportTypeFactory implements ImportTypeFactoryInterface
{
    /**
     * @param ImportTypeServiceInterface[] $importTypes
     */
    public function __construct(protected array $importTypes)
    {
    }

    /**
     * @param ImportFormDto $entityDto
     *
     * @return ImportTypeServiceInterface
     */
    public function getImportType(ImportFormDto $entityDto): ImportTypeServiceInterface
    {
        return $entityDto->getApi() ?
            $this->importTypes[static::IMPORT_TYPE_API_NAME] :
            $this->importTypes[static::IMPORT_TYPE_FILE_NAME];
    }
}
