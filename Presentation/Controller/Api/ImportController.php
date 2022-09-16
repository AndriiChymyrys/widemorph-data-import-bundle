<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Presentation\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Presentation\Form\Type\ImportFormType;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Interaction\DomainInteractionInterface;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Interaction\MorphCoreInteractionInterface;

/**
 * Class ImportController
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Presentation\Controller\Api
 */
class ImportController extends AbstractController
{
    public function import(
        MorphCoreInteractionInterface $morphCoreInteraction,
        DomainInteractionInterface $domainInteraction
    ) {
        $formSubmitService = $morphCoreInteraction->getDomainInteraction()->getFormSubmitService();

        $formSubmitService->submitForm(ImportFormType::class);

        if (!$formSubmitService->getForm()->isValid()) {
            return $this->json($formSubmitService->getFormErrors());
        }

        $data = $formSubmitService->getForm()->getData();

        $domainInteraction->getImportTypeFactory()->getImportType($data)->importEntity($data);

        return $this->json([]);
    }
}
