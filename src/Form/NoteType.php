<?php

namespace App\Form;

use App\Entity\FicheInscription;
use App\Entity\Matiere;
use App\Entity\Note;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Valeur', NumberType::class)
            ->add('Observation', TextType::class)
            ->add('matiere', EntityType::class, [
                'class'=> Matiere::class,
                'choice_label'=>'matiere'
            ])
            ->add('IdFiche', EntityType::class, [
                'class'=> FicheInscription::class,
                'choice_label'=> 'IdFiche'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Note::class,
        ]);
    }
}
