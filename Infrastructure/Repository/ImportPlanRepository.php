<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Infrastructure\Repository;

use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Infrastructure\Entity\ImportPlan;

/**
 * Class ImportPlanRepository
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Infrastructure\Repository
 */
class ImportPlanRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     * @param string $entityClass
     */
    public function __construct(ManagerRegistry $registry, string $entityClass = ImportPlan::class)
    {
        parent::__construct($registry, $entityClass);
    }
}
