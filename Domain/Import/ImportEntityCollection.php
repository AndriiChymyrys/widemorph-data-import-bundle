<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import;

use Doctrine\ORM\EntityManagerInterface;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\DTO\ImportForm\EntityImportFormDto;

/**
 * Class ImportEntityCollection
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import
 */
class ImportEntityCollection implements ImportEntityCollectionInterface
{
    /**
     * @var array
     */
    public array $entities = [];

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(protected EntityManagerInterface $entityManager)
    {
    }

    /**
     * {@inheritDoc}
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getEntity(EntityImportFormDto $entityImportFormDto, array $row): object
    {
        $identifyValue = $row[$entityImportFormDto->getAsIdentifierColumn()] ?? null;

        if (!$identifyValue) {
            return $this->createNewEntity($entityImportFormDto);
        }

        $cacheEntity = $this->entities[$entityImportFormDto->getNamespace()][$this->getIdentifierHash(
            $identifyValue
        )] ?? null;

        if ($cacheEntity) {
            return $cacheEntity;
        }

        $entity = $this->fetchEntity($entityImportFormDto, $identifyValue);

        if (!$entity) {
            $entity = $this->createNewEntity($entityImportFormDto);
        }

        $this->entities[$entityImportFormDto->getNamespace()][$this->getIdentifierHash($identifyValue)] = $entity;

        return $entity;
    }

    /**
     * @param EntityImportFormDto $entityImportFormDto
     *
     * @return object
     */
    protected function createNewEntity(EntityImportFormDto $entityImportFormDto): object
    {
        $namespace = $entityImportFormDto->getNamespace();

        $entity = new $namespace();

        $this->entityManager->persist($entity);

        return $entity;
    }

    /**
     * @param EntityImportFormDto $entityImportFormDto
     * @param mixed $identifyValue
     *
     * @return null|object
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    protected function fetchEntity(EntityImportFormDto $entityImportFormDto, mixed $identifyValue): null|object
    {
        $queryBuilder = $this->entityManager->getRepository($entityImportFormDto->getNamespace())
            ->createQueryBuilder('t');

        return $queryBuilder
            ->where($queryBuilder->expr()->eq('t.' . $entityImportFormDto->getAsIdentifierColumn(), ':value'))
            ->setParameter('value', $identifyValue)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param string $identifier
     *
     * @return string
     */
    protected function getIdentifierHash(string $identifier): string
    {
        return md5($identifier);
    }
}
