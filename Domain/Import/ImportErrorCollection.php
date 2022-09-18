<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import;

/**
 * Class ImportErrorCollection
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import
 */
class ImportErrorCollection implements ImportErrorCollectionInterface
{
    /** @var array */
    protected array $errors = [];

    /**
     * {@inheritDoc}
     */
    public function addError(string $message): void
    {
        $this->errors[] = $message;
    }

    /**
     * {@inheritDoc}
     */
    public function reset(): void
    {
        $this->errors = [];
    }

    /**
     * {@inheritDoc}
     */
    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    /**
     * {@inheritDoc}
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
