<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection;

use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\EntityReflectionInterface;

/**
 * Class EntityCollectionInterface
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection
 */
interface EntityCollectionInterface
{
    /**
     * @param EntityReflectionInterface $entityReflection
     *
     * @return void
     */
    public function add(EntityReflectionInterface $entityReflection): void;

    /**
     * @return EntityReflectionInterface
     */
    public function getFirst(): EntityReflectionInterface;
}
