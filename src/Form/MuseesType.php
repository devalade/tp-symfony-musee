<?php

namespace App\Form;

use App\Entity\Musees;
use App\Entity\Pays;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MuseesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numMus', NumberType::class, [
                'label' => 'Numero du Musee'
            ])
            ->add('nomMus',null, [
                'label' => 'Nom du Musee'
            ])
            ->add('nblivres', NumberType::class, [
                'label' => 'Nombre de livres'
            ])
            ->add('codePays', EntityType::class, [
                'class' => Pays::class,
                'choice_label' => function($pays) {
                    return $pays->getCodePays();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Musees::class,
        ]);
    }
}
