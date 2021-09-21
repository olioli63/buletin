<?php

namespace App\Form;

use App\Entity\Inscription;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Annee', NumberType::class)
            // ->add('idUser', EntityType::class, [
            //     'class'=> User::class,
            //     'choice_label'=>'Id'
            // ])
            ->add('IdClasse', EntityType::class, [
                'class'=>Classe::class,
                'choice_label'=>'Id'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Inscription::class,
        ]);
    }
}
