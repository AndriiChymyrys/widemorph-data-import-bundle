<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import;

/**
 * Class ImportErrorCollectionInterface
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import
 */
interface ImportErrorCollectionInterface
{
    /**
     * @param string $message
     *
     * @return void
     */
    public function addError(string $message): void;

    /**
     * @return void
     */
    public function reset(): void;

    /**
     * @return bool
     */
    public function hasErrors(): bool;

    /**
     * @return array
     */
    public function getErrors(): array;
}
