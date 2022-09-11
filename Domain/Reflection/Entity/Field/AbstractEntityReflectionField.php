<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\Field;

use JsonSerializable;
use ReflectionProperty;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\Common\Annotations\AnnotationReader;

/**
 * Class AbstractEntityReflectionField
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\Field
 */
abstract class AbstractEntityReflectionField implements EntityReflectionFieldInterface, JsonSerializable
{
    /**
     * @param ReflectionProperty $property
     * @param AnnotationReader $annotationReader
     */
    public function __construct(
        protected readonly  ReflectionProperty $property,
        protected readonly AnnotationReader $annotationReader
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return $this->property->getName();
    }

    /**
     * {@inheritDoc}
     */
    public function getFieldViewType(): string
    {
        $annotation = $this->getFieldAnnotation();

        if (!$annotation) {
            return static::DEFAULT_FIELD_VIEW_TYPE;
        }

        return match($annotation::class) {
            ManyToOne::class, ManyToMany::class => static::FIELD_VIEW_TYPE_MANY_TO_ONE,
            default => static::DEFAULT_FIELD_VIEW_TYPE
        };
    }

    /**
     * {@inheritDoc}
     */
    public function getFieldAnnotation(): mixed
    {
        $annotations = $this->getAnnotations();

        return $annotations[0] ?? null;
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->getName(),
            'annotation' => $this->getFieldAnnotation(),
            'viewType' => $this->getFieldViewType(),
        ];
    }

    /**
     * @return array
     */
    protected function getAnnotations(): array
    {
        return $this->annotationReader->getPropertyAnnotations($this->property);
    }
}
