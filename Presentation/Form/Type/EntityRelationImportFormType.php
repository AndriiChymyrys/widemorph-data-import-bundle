<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Presentation\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\DTO\ImportForm\EntityImportFormDto;

/**
 * Class EntityRelationImportFormType
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Presentation\Form\Type
 */
class EntityRelationImportFormType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function getParent(): string
    {
        return BaseEntityImportFormType::class;
    }

    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EntityImportFormDto::class,
            'csrf_protection' => false,
        ]);
    }
}
