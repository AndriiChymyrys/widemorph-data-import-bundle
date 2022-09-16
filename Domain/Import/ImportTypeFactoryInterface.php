<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import;

use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\DTO\ImportForm\ImportFormDto;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Type\ImportTypeServiceInterface;

interface ImportTypeFactoryInterface
{
    public const IMPORT_TYPE_API_NAME = 'api';
    public const IMPORT_TYPE_FILE_NAME = 'file';

    public function getImportType(ImportFormDto $entityDto): ImportTypeServiceInterface;
}
