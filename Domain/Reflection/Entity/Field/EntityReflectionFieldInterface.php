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
    /** @var string */
    public const FIELD_VIEW_TYPE_TEXT = 'text';

    /** @var string */
    public const FIELD_VIEW_TYPE_MANY_TO_ONE = 'manytoone';

    /** @var string */
    public const DEFAULT_FIELD_VIEW_TYPE = self::FIELD_VIEW_TYPE_TEXT;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getFieldViewType(): string;

    /**
     * @return mixed
     */
    public function getFieldAnnotation(): mixed;
}
