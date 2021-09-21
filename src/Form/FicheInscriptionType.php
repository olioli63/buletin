<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Eleve;
use App\Entity\FicheInscription;
use App\Entity\Inscription;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FicheInscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Date')
            ->add('Remarque')
            ->add('Id_Inscription', EntityType::class, [
                'class'=>Inscription::class,
                'choice_label'=> 'Id'
            ])
            ->add('IdEleve', EntityType::class, [
                'class'=> Eleve::class,
                'choice_label'=>'Id'
            ])
            ->add('NomClasse', EntityType::class, [
                'class'=> Classe::class,
                'choice_label'=>'Id'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FicheInscription::class,
        ]);
    }
}
