<?php

namespace App\Form;

use App\Entity\SubCategory;
use App\Entity\Paints;
use App\Entity\Category;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class PaintsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre de la peinture',
                'required' => false
            ])
            ->add('category', EntityType::class, [
                'label' => 'Choisir une catégorie',
                'class' => Category::class,
                'choice_label' => 'name'
            ] )
            ->add('SubCategory', EntityType::class, [
                'label' => 'Choisir une sous catégorie',
                'class' => SubCategory::class,
                'choice_label' => 'name'
            ] )
            ->add('destination', TextareaType::class, [
                'label' => 'Destination',
                'attr' => ['rows' => 5],
                'required' => false
            ])
            ->add('features', TextareaType::class, [
                'label' => 'Caractéristique',
                'attr' => ['rows' => 5],
                'required' => false
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => ['rows' => 5],
                'required' => false
            ])
            ->add('price', MoneyType::class, [
                'label' => 'prix',
                'required' => false,
                'currency' => 'EUR'
            ])
            ->add('coverFile', VichImageType::class, [
                'required' => false,
                'label' => 'Image de la peinture',
                'download_label' => false,
                'delete_label' => 'Cocher pour supprimer cette image',
                'imagine_pattern' => 'thumb',
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
