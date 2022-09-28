<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Presentation\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\DTO\ImportForm\ApiImportFormDto;

/**
 * Class ApiImportFormType
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Presentation\Form\Type
 */
class ApiImportFormType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('url', TextType::class);
    }

    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ApiImportFormDto::class,
            'csrf_protection' => false,
        ]);
    }
}
