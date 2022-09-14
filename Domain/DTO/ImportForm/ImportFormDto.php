<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\DTO\ImportForm;

class ImportFormDto
{
    public $file;

    public EntityImportFormDto $entity;
}
