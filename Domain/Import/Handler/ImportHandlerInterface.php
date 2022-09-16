<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Handler;

use Generator;

interface ImportHandlerInterface
{
    public function handle(Generator $generator): void;
}
