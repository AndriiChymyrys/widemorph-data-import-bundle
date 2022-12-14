<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Presentation\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\DTO\ImportForm\EntityImportFormDto;

/**
 * Class EntityImportFormType
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Presentation\Form\Type
 */
class EntityImportFormType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'relations',
                CollectionType::class,
                [
                    'entry_type' => EntityRelationImportFormType::class,
                    'allow_add' => true
                ]
            );
    }

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
