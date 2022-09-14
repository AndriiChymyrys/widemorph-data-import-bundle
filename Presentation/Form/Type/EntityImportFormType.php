<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Presentation\Form\Type;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\DTO\ImportForm\EntityImportFormDto;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Presentation\Form\DataTransformer\EntityFieldsTransformer;

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
            ->add('namespace')
            ->add('fields', null, ['constraints' => new NotBlank()]);

        $builder->get('fields')->addModelTransformer(new EntityFieldsTransformer());

        $builder->addEventListener(FormEvents::PRE_SUBMIT, [$this, 'onPreSubmitData']);
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

    /**
     * @param FormEvent $event
     *
     * @return void
     * @throws \JsonException
     */
    public function onPreSubmitData(FormEvent $event): void
    {
        $data = $event->getData();

        $data = json_decode(json: $data, associative: true, flags: JSON_THROW_ON_ERROR);

        if (isset($data['fields'])) {
            $data['fields'] = json_encode($data['fields'], JSON_THROW_ON_ERROR);
        }

        $event->setData($data);
    }
}
