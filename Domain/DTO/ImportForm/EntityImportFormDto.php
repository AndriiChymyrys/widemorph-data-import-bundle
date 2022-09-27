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
     * @var string
     */
    public string $asIdentifierColumn;

    /**
     * @var array<EntityImportFormDto>
     */
    public array $relations = [];

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

    /**
     * @param array $fields
     */
    public function setFields(array $fields): void
    {
        $this->fields = $fields;
    }

    /**
     * @return string
     */
    public function getAsIdentifierColumn(): string
    {
        return $this->asIdentifierColumn;
    }

    /**
     * @return array<EntityImportFormDto>
     */
    public function getRelations(): array
    {
        return $this->relations;
    }
}
