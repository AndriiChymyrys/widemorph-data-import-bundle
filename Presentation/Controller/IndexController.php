<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Presentation\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Interaction\DomainInteractionInterface;

class IndexController extends AbstractController
{
    public function entitiesList(DomainInteractionInterface $domainInteraction): Response
    {
        return $this->render(
            '@MorphDataImport/index/index.html.twig',
            ['entities' => $domainInteraction->getEntityReflectionService()->getEntitiesList()]
        );
    }

    public function entityImport(DomainInteractionInterface $domainInteraction, string $entityName): Response
    {
        return $this->render(
            '@MorphDataImport/index/entity_import.html.twig',
            ['entityReflection' => $domainInteraction->getEntityReflectionService()->getEntityReflection($entityName)]
        );
    }
}
