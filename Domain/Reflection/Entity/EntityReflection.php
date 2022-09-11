<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity;

use JsonSerializable;
use Doctrine\ORM\Mapping\OneToMany;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\Field\EntityReflectionFieldInterface;

/**
 * Class EntityReflection
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity
 */
class EntityReflection implements EntityReflectionInterface, JsonSerializable
{
    /** @var string[] */
    protected const DEFAULT_EXCLUDE_PROPERTIES = ['id'];

    /** @var string[] */
    protected const ANNOTATIONS_TO_EXCLUDE = [OneToMany::class];

    /**
     * @var array
     */
    protected array $fields;

    /**
     * @param string $namespace
     * @param array $config
     */
    public function __construct(protected readonly string $namespace, protected readonly array $config)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function addField(EntityReflectionFieldInterface $field): void
    {
        $this->fields[$field->getName()] = $field;
    }

    /**
     * {@inheritDoc}
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * {@inheritDoc}
     */
    public function getUiFields(): array
    {
        $excludeProperties = static::DEFAULT_EXCLUDE_PROPERTIES;

        if (isset($this->config['exclude_properties'])) {
            $excludeProperties = array_merge($excludeProperties, $this->config['exclude_properties']);
        }

        return $this->excludeByAnnotation(array_diff_key($this->fields, array_flip($excludeProperties)));
    }

    /**
     * {@inheritDoc}
     */
    public function getNamespace(): string
    {
        return $this->namespace;
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize(): array
    {
        return [
            'namespace' => $this->getNamespace(),
            'fields' => $this->getUiFields(),
        ];
    }

    /**
     * @param EntityReflectionFieldInterface[] $fields
     *
     * @return array
     */
    protected function excludeByAnnotation(array $fields): array
    {
        $filtered = [];

        foreach ($fields as $field) {
            if ($field->getFieldAnnotation() && !in_array(
                    $field->getFieldAnnotation()::class,
                    static::ANNOTATIONS_TO_EXCLUDE,
                    true
                )) {
                $filtered[] = $field;
            }
        }

        return $filtered;
    }
}
