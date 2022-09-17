<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Handler;

use Generator;
use Doctrine\ORM\EntityManagerInterface;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\DTO\ImportForm\ImportFormDto;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Exception\ImportHandlerException;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\EntityReflectionInterface;

class SimpleImportHandlerService implements ImportHandlerInterface
{
    public function __construct(protected EntityManagerInterface $entityManager)
    {
    }

    public function handle(
        Generator $generator,
        ImportFormDto $entityDto,
        EntityReflectionInterface $entityReflection
    ): void {
        foreach ($generator as $row) {
            foreach ($row as $fieldName => $value) {
                $entity = $this->getEntity($entityDto->getEntity()->getNamespace());
                $method = $this->getSetMethod($fieldName, $entity);

                $entity->{$method}($value);

                $this->entityManager->persist($entity);
            }
        }

        $this->entityManager->flush();
    }

    protected function getEntity(string $namespace): object
    {
        return new $namespace();
    }

    protected function getSetMethod(string $fieldName, object $entity): string
    {
        $method = 'set' . ucfirst($fieldName);

        if (!method_exists($entity, $method)) {
            throw new ImportHandlerException(
                sprintf('Method "%s" not found in entity "%s"', $method, get_class($entity))
            );
        }

        return $method;
    }
}
