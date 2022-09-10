<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\Field;

use ReflectionProperty;

/**
 * Class EntityFieldFactoryInterface
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\Field
 */
interface EntityFieldFactoryInterface
{
    /**
     * @param ReflectionProperty $property
     *
     * @return EntityReflectionFieldInterface
     */
    public function createEntityField(ReflectionProperty $property): EntityReflectionFieldInterface;
}
