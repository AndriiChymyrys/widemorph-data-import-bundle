<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Infrastructure\Twig;

use Twig\TwigTest;
use Twig\Extension\AbstractExtension;

/**
 * Class TwigExtension
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Infrastructure\Twig
 */
class TwigExtension extends AbstractExtension
{
    /**
     * {@inheritDoc}
     */
    public function getTests()
    {
        return [
            new TwigTest('instanceof', [$this, 'isInstanceof'])
        ];
    }

    /**
     * @param $var
     * @param $instance
     *
     * @return bool
     */
    public function isInstanceof($var, $instance): bool
    {
        return $var instanceof $instance;
    }
}
