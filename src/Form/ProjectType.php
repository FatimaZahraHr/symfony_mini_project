<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProjectType extends AbstractType
{
     /**
     * Permet d'avoir la configuration de base d'un champ
     * @param string $label
     * @param string $placeholder
     * @param array $options
     * @return array
     */
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
        ->add('nomprojet', TextType::class,$this->getConfiguration("Nom du projet","Tapez le nom du projet"))
        ->add('numero', TextType::class,$this->getConfiguration("Numéro du dossier","Tapez le numéro du dossier"))
        ->add('type', TextType::class,$this->getConfiguration("Type de projet","Tapez le type de projet"))
        ->add('equipe', TextType::class,$this->getConfiguration("Equipe","l'équipe qui suivez le projet"))
        ->add('note', TextType::class,$this->getConfiguration("Notes","les notes ..."))
        ->add('annee', TextType::class,$this->getConfiguration("Année","l'année du projet"))
        ->add('idclient',EntityType::class,array('class'=>'App\Entity\Client','choice_label'=>'nom','expanded'=>false,'multiple'=>false,
        'attr' => [   
            'class'=>'form-control',
            ] ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,        ]);
    }
}
