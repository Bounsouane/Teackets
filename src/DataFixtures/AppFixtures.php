<?php

namespace App\DataFixtures;

use App\Entity\Ticket;
use App\Entity\User;
use App\Repository\TicketRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use phpDocumentor\Reflection\Types\Self_;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public const USER_REFERENCE = 'ref-user';

    private UserPasswordHasherInterface $hasher;

    //injection de dépendance
    public function __construct(UserPasswordHasherInterface $hasher, UserRepository $userRepository,TicketRepository $ticketRepository)
    {
        $this->hasher = $hasher;
        $this->userRepository = $userRepository;
        $this->ticketRepository = $ticketRepository;
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $this->addUsers($manager);
    }

    private function addUsers(ObjectManager $manager)
    {
        $generator = Factory::create('fr_FR');

        //Création des users

        for ($i = 0;$i<10;$i++) {

            $user = new User();
            $user
                ->setEmail($generator->email)
                ->setUsername($generator->userName)
                ->setNom($generator->lastName)
                ->setPrenom($generator->lastName)
                ->setCodePostal($generator->postcode)
                ->setTelephone($generator->phoneNumber)
                ->setVille($generator->city);

                $password = $this->hasher->hashPassword($user,'123456');
                $user->setPassword($password);

                $manager->persist($user);


                $manager->flush();

//                $this->addReference(self::USER_REFERENCE,$user);


        }

        //Création des tickets

        for ($i = 0; $i <10; $i++) {

            //initialisation des users
//            $users = $this->userRepository->findAll();
//            $tirage = rand(0,8);
//            $randomUser = $users($tirage);
//            $user = $users[$tirage];

            $ticket = new Ticket();
            $ticket
                ->setCategorie($generator->randomElement(["Guitare","Piano","Batterie","Flûte"]))
                ->setDelai($generator->randomElement(["3 jours","5 jours","9 jours"]))
//                ->setDateCloture($generator->dateTimeBetween(['+3 days'],['+9 days']))
                ->setDescription($generator->text)
                ->setStatut($generator->randomElement(["En cours 1/2","En cours 2/2","Problème","Terminé","Archivé"]))
                ->setPriorite("En cours")
                ->setDateOuverture(new \DateTime('now',null))
                ->setDescriptionSolution($generator->text)
                ->addUser($user);

            $manager->persist($ticket);
            $manager->flush();

        }

    }
}
