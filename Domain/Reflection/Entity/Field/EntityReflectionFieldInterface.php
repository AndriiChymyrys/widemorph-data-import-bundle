<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\Field;

/**
 * Class EntityReflectionFieldInterface
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\Field
 */
interface EntityReflectionFieldInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return mixed
     */
    public function getFieldAnnotation(): mixed;

    /**
     * @return bool
     */
    public function isRelation(): bool;
}
