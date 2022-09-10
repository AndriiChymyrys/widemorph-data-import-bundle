<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\Field;

use ReflectionProperty;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\Common\Annotations\AnnotationReader;

abstract class AbstractEntityReflectionField implements EntityReflectionFieldInterface
{
    public function __construct(
        protected readonly  ReflectionProperty $property,
        protected readonly AnnotationReader $annotationReader
    ) {
    }

    public function getName(): string
    {
        return $this->property->getName();
    }

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

    public function getFieldAnnotation(): mixed
    {
        $annotations = $this->getAnnotations();

        return $annotations[0] ?? null;
    }

    protected function getAnnotations(): array
    {
        return $this->annotationReader->getPropertyAnnotations($this->property);
    }
}
