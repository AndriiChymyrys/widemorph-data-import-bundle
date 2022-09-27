<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Presentation\Form\Type;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Presentation\Form\DataTransformer\EntityFieldsTransformer;

/**
 * Class BaseEntityImportFormType
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Presentation\Form\Type
 */
class BaseEntityImportFormType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('namespace', TextType::class, ['constraints' => new NotBlank()])
            ->add('asIdentifierColumn', TextType::class, ['constraints' => new NotBlank()])
            ->add('fields', null, ['constraints' => new NotBlank()]);

        $builder->get('fields')->addModelTransformer(new EntityFieldsTransformer());

        $builder->addEventListener(FormEvents::PRE_SUBMIT, [$this, 'onPreSubmitData']);
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

        if (is_array($data)) {
            return;
        }

        $data = json_decode(json: $data, associative: true, flags: JSON_THROW_ON_ERROR);

        if (isset($data['fields'])) {
            $data['fields'] = json_encode($data['fields'], JSON_THROW_ON_ERROR);
        }

        if (isset($data['relations']) && is_array($data['relations'])) {
            foreach ($data['relations'] as &$relation) {
                $relation['fields'] = json_encode($relation['fields'], JSON_THROW_ON_ERROR);
            }

            unset($relation);
        }

        $event->setData($data);
    }
}
