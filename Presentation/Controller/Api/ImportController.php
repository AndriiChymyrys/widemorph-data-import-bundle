<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Presentation\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Presentation\Form\Type\ImportFormType;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Interaction\MorphCoreInteractionInterface;

class ImportController extends AbstractController
{
    public function import(MorphCoreInteractionInterface $morphCoreInteraction)
    {
        $formSubmitService = $morphCoreInteraction->getDomainInteraction()->getFormSubmitService();

        $formSubmitService->submitForm(ImportFormType::class);

        if (!$formSubmitService->getForm()->isValid()) {
            return $this->json(data: $formSubmitService->getFormErrors());
        }

        $data = $formSubmitService->getForm()->getData();

        return $this->json(data: []);
    }
}
