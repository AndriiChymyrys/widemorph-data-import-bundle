<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Infrastructure\Twig;

use Twig\TwigTest;
use Twig\Extension\AbstractExtension;

class TwigExtension extends AbstractExtension
{
    public function getTests()
    {
        return [
            new TwigTest('instanceof', [$this, 'isInstanceof'])
        ];
    }

    public function isInstanceof($var, $instance): bool
    {
        return $var instanceof $instance;
    }
}
