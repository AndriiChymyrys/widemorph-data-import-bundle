<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection;

interface EntityFileManagerInterface
{
    public function scanEntityFolder(): array;

    public function getEntityNameSpace(string $entityName): string;
}
