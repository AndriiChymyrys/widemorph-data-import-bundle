<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\Field;

use ReflectionProperty;
use Doctrine\Common\Annotations\AnnotationReader;

/**
 * Class EntityFieldFactory
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\Field
 */
class EntityFieldFactory implements EntityFieldFactoryInterface
{
    /**
     * @param AnnotationReader $annotationReader
     */
    public function __construct(protected readonly AnnotationReader $annotationReader)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function createEntityField(ReflectionProperty $property): EntityReflectionFieldInterface
    {
        return new EntitySimpleReflectionField($property, $this->annotationReader);
    }
}
