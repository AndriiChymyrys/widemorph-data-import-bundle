<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Presentation\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Presentation\Form\Type\ImportFormType;

class ImportController extends AbstractController
{
    public function import(Request $request)
    {
        $form = $this->createForm(ImportFormType::class);
        $form->handleRequest($request);
    }
}
