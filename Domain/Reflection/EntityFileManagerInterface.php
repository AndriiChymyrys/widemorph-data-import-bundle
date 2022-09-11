<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection;

/**
 * Class EntityFileManagerInterface
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection
 */
interface EntityFileManagerInterface
{
    /**
     * @return array
     */
    public function scanEntityFolder(): array;

    /**
     * @param string $entityName
     *
     * @return string
     */
    public function getEntityNameSpace(string $entityName): string;
}
