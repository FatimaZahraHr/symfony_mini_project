<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ClientType extends AbstractType
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
        ->add('nom', TextType::class,$this->getConfiguration("Nom du client","Tapez le nom du client"))
        ->add('agence', TextType::class,$this->getConfiguration("Agence partenaires","agence partenaire de ce client"))
        ->add('note', TextType::class,$this->getConfiguration("Notes","tapez des notes sur votre client"))
    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
