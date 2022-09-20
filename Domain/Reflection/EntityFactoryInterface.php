<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection;

use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\EntityReflectionInterface;

/**
 * Class EntityFactoryInterface
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection
 */
interface EntityFactoryInterface
{
    /**
     * @param string $namespace
     *
     * @return EntityReflectionInterface
     */
    public function getEntityReflection(string $namespace): EntityReflectionInterface;
}
