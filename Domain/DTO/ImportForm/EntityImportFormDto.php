<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\DTO\ImportForm;

/**
 * Class EntityImportFormDto
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\DTO\ImportForm
 */
class EntityImportFormDto
{
    /**
     * @var string
     */
    public string $namespace;

    /**
     * @var array
     */
    public array $fields;

    /**
     * @return string
     */
    public function getNamespace(): string
    {
        return $this->namespace;
    }

    /**
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }
}
