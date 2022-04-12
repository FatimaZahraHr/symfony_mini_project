<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TacheType extends AbstractType
{
    
    private function getConfiguration($label, $placeholder, $options= []){
        return array_merge([
            'label' =>$label,
            'attr' => [
            'placeholder'=>$placeholder,
            'class'=>'form-control'
                      ]   
            ], $options);
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('categorie',EntityType::class,array('class'=>'App\Entity\Categorie','choice_label'=>'nom','expanded'=>false,'multiple'=>false, 'attr' => [   
            'class'=>'form-control',
            ] ))
        ->add('nom', TextType::class,$this->getConfiguration("Tache","Créer un nouvelle tâche"))
       
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
