<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity;

use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Handler\ImportHandlerInterface;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\Field\EntityReflectionFieldInterface;

/**
 * Class EntityReflectionInterface
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity
 */
interface EntityReflectionInterface
{
    /**
     * @return string
     */
    public function getNamespace(): string;

    /**
     * @param EntityReflectionFieldInterface $field
     *
     * @return void
     */
    public function addField(EntityReflectionFieldInterface $field): void;

    /**
     * @return EntityReflectionFieldInterface[]
     */
    public function getFields(): array;

    /**
     * @return EntityReflectionFieldInterface[]
     */
    public function getUiFields(): array;

    /**
     * @return ImportHandlerInterface|null
     */
    public function getImportHandler(): ?ImportHandlerInterface;
}
