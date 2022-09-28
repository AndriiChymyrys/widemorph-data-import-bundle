<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\DTO\ImportForm;

/**
 * Class ApiImportFormDto
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\DTO\ImportForm
 */
class ApiImportFormDto
{
    /**
     * @var string|null
     */
    public ?string $url;

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }
}
