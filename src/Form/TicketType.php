<?php

namespace App\Form;

use App\Entity\Ticket;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;

class TicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
//            ->add('dateOuverture',DateType::class)
//            ->add('dateCloture',DateType::class)
//            ->add('statut', ChoiceType::class, [
//                'choices' => [
//                    'À traiter' => 'à traiter',
//                    'En cours 1/2' => 'en cours 1/2',
//                    'En cours 2/2' => 'en cours 2/2',
//                    'Problème' => 'problème',
//                    'Terminé' => 'terminé',
//                    'Archivé' => 'archivé'
//                ]
//            ])
            ->add('categorie', ChoiceType::class, [
                'choices' => [
                    'Guitare' => 'guitare',
                    'Piano' => 'piano',
                    "Chant" => "chant"
                ]])
            ->add('description', TextareaType::class)
//            ->add('descriptionSolution', TextareaType::class)
            ->add('priorite', ChoiceType::class, [
                'choices' => [
                    'Normal' => 'normal',
                    "Urgent" => 'urgent'
                ]
            ])
            ->add('delai')
//            ->add('users', RegistrationFormType::class, [
//                'data_class' => User::class,
//            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ticket::class,
        ]);
    }
}
