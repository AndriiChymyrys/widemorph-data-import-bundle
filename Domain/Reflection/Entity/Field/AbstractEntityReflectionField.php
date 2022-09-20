<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\Field;

use JsonSerializable;
use ReflectionProperty;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
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
        protected readonly ReflectionProperty $property,
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
    public function getFieldAnnotation(): mixed
    {
        $annotations = $this->getAnnotations();

        return $annotations[0] ?? null;
    }

    /**
     * {@inheritDoc}
     */
    public function isRelation(): bool
    {
        $annotation = $this->getFieldAnnotation();

        return in_array(
            $annotation::class,
            [ManyToOne::class, ManyToMany::class, OneToMany::class, OneToOne::class],
            true
        );
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize(): array
    {
        return [
            'name' => $this->getName(),
            'annotation' => $this->getFieldAnnotation(),
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
