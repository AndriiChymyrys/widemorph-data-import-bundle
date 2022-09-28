<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\DTO\ImportForm;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class ImportFormDto
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\DTO\ImportForm
 */
class ImportFormDto
{
    /**
     * @var UploadedFile|null
     */
    public ?UploadedFile $file;

    /**
     * @var ApiImportFormDto|null
     */
    public ?ApiImportFormDto $api = null;

    /**
     * @var EntityImportFormDto
     */
    public EntityImportFormDto $entity;

    /**
     * @return UploadedFile|null
     */
    public function getFile(): ?UploadedFile
    {
        return $this->file;
    }

    /**
     * @return EntityImportFormDto
     */
    public function getEntity(): EntityImportFormDto
    {
        return $this->entity;
    }

    /**
     * @return ApiImportFormDto|null
     */
    public function getApi(): ?ApiImportFormDto
    {
        return $this->api;
    }
}
