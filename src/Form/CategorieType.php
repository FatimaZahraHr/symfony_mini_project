<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CategorieType extends AbstractType
{ 
    private function getConfiguration($label, $placeholder, $options= []){
    return array_merge([
        'label' =>$label,
        'attr' => [
        'placeholder'=>$placeholder,
        'class'=>'form-control',
                  ]   
        ], $options);
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom', TextType::class,$this->getConfiguration("Catégorie","Créer une catégorie"))

    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
