<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Presentation\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

/**
 * Class EntityFieldsTransformer
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Presentation\Form\DataTransformer
 */
class EntityFieldsTransformer implements DataTransformerInterface
{
    /**
     * {@inheritDoc}
     */
    public function transform(mixed $value)
    {
        return $value;
    }

    /**
     * {@inheritDoc}
     */
    public function reverseTransform(mixed $value)
    {
        return json_decode(json: $value, associative: true, flags: JSON_THROW_ON_ERROR);
    }
}