<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity;

use JsonSerializable;
use Doctrine\ORM\Mapping\OneToMany;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Handler\ImportHandlerInterface;
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

    /**
     * @var array<string, EntityReflectionFieldInterface|EntityReflectionInterface>
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
    public function addField(
        EntityReflectionFieldInterface $field,
        EntityReflectionInterface $entityReflection = null
    ): void {
        if ($entityReflection && $field->isRelation()) {
            $this->fields[$field->getName()] = $entityReflection;
        } else {
            $this->fields[$field->getName()] = $field;
        }
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

        return array_diff_key($this->fields, array_flip($excludeProperties));
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
     * {@inheritDoc}
     */
    public function getImportHandler(): ?ImportHandlerInterface
    {
        return $this->config['handler'] ?? null;
    }
}
