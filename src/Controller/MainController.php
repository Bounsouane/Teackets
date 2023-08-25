<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\MailType;
use App\Entity\Ticket;
use App\Entity\User;
use App\Repository\AnnonceRepository;
use App\Repository\MailTypeRepository;
use App\Repository\TicketRepository;
use App\Repository\UserRepository;
use Faker\Provider\fr_FR\Internet;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main_home')]
    public function home(): Response
    {
        return $this->render('main/home.html.twig');
    }

    #[Route('/about-us', name: 'main_about_us')]
    public function aboutUs(): Response
    {
        return $this->render('main/about_us.html.twig');
    }

    #[Route('/test', name: 'main_test')]
    public function test(TicketRepository $ticketRepository, UserRepository $userRepository,MailTypeRepository $mailTypeRepository,AnnonceRepository $annonceRepository ): Response
    {


        //Ajout de différentes instances d'objet pour tester la bonne inscription dans la base de données

        //instanciation d'un objet user
        $user = new User();

        $user
            ->setRoles(["Test"])
            ->setEmail("Test")
            ->setUsername("Testeur")
            ->setNom("NomTest")
            ->setPrenom("JeanTest")
            ->setCodePostal("12345")
            ->setPassword("123456")
            ->setTelephone("1234567890")
            ->setVille("TestVille");

        $userRepository->save($user,true);


        //instanciation d'un objet ticket
        $ticket = new Ticket();

        $ticket
        ->setCategorie("Musique")
        ->setDelai("3 jours")
        ->setDateCloture(new \DateTime("+2 month"))
        ->setDescription("Un problème pour trouver un professeur de guitare péruvienne.")
        ->setPriorite("Urgent.")
        ->setStatut("En cours")
        ->setDateOuverture(new \DateTime('now'))
        ->setDescriptionSolution("J'en ai trouvé un et l'élève et lui se sont mis en contact.");


        $ticketRepository->save($ticket,true);



        //instanciation d'un objet mail type
        $mailType = new MailType();

        $mailType
            ->setType("résumé-mission")
            ->setTitre("Mail Test")
            ->setContenu("Je vérifie le contentu dans la base de données");

        $mailTypeRepository->save($mailType,true);

        //instanciation d'une annonce
        $annonce = new Annonce();

        $annonce
            ->setLieuCours("RennesTest")
            ->setCoursEnLigne("test")
            ->setCoursPack("test")
            ->setDescriptionCours("test")
            ->setNombreEleves(123)
            ->setPhotoProfil("null")
            ->setPremierCoursOffert(true)
            ->setQuestionFAQ1("test")
            ->setQuestionFAQ2("test")
            ->setTarifEnLigne("test")
            ->setTarifHoraire(12.3)
            ->setTempsCoursOffert(123)
            ->setTempsReponse(123);

        $annonceRepository -> save($annonce,true);
        return $this->render("main/test.html.twig",[
            "Test d'insertion d'un utilisateur : " => $user,
            "Test d'insertion d'un ticket : " => $ticket,
            "Test d'insertion d'un mail type : " => $mailType,
            "Test d'insertion d'une annonce : " => $annonce

        ]);
    }



}
