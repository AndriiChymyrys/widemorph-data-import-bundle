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
    public const FIELD_VIEW_TYPE_TEXT = 'text';
    public const FIELD_VIEW_TYPE_MANY_TO_ONE = 'manytoone';
    public const DEFAULT_FIELD_VIEW_TYPE = self::FIELD_VIEW_TYPE_TEXT;

    public function getName(): string;

    public function getFieldViewType(): string;

    public function getFieldAnnotation(): mixed;
}
