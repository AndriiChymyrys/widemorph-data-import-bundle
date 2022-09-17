<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Handler;

use Generator;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\DTO\ImportForm\ImportFormDto;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\EntityReflectionInterface;

interface ImportHandlerInterface
{
    public function handle(
        Generator $generator,
        ImportFormDto $entityDto,
        EntityReflectionInterface $entityReflection
    ): void;
}
