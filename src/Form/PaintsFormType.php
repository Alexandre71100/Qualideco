<?php

namespace App\Form;

use App\Entity\Paints;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PaintsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre de la peinture',
                'required' => false
            ])
            ->add('cover')
            ->add('destination', TextType::class, [
                'label' => 'Destination',
                'required' => false
            ])
            ->add('features', TextType::class, [
                'label' => 'Caractéristique',
                'required' => false
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
                'required' => false
            ])
            ->add('price', MoneyType::class, [
                'label '=> 'Prix de la peinture',
                'required' => false,
                'currency' => 'EUR'
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Paints::class,
        ]);
    }
}
