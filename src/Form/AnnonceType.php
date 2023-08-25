<?php

namespace App\Form;

use App\Entity\Annonce;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tarifHoraire', IntegerType::class,[
                'required' => false,
                'error_bubbling' => true,
                'attr' => [
                    'min' => 20
                ]
            ])
            ->add('tempsReponse')
            ->add('nombreEleves', IntegerType::class)
            ->add('premierCoursOffert')
            ->add('lieuCours')
            ->add('coursEnLigne')
            ->add('coursPack')
            ->add('tarifEnLigne')
            ->add('tempsCoursOffert')
            ->add('descriptionCours', TextareaType::class)
            ->add('questionFAQ1')
            ->add('questionFAQ2')
//            ->add('prof')
//            ->add('professeur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annonce::class,
        ]);
    }
}
