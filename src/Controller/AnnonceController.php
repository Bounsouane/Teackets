<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Form\AnnonceType;
use App\Repository\AnnonceRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/annonce', name : 'annonce_')]
class AnnonceController extends AbstractController
{
    #[Route('/', name: '')]
    public function index(): Response
    {
        return $this->render('annonce/index.html.twig');
    }

    #[Route('/add', name: 'add')]
    public function add(Request $request,
                        AnnonceRepository $annonceRepository): Response
    {
        $annonce = new Annonce();

        //instanciation du formulaire en lui passant l'instance de ticket
        $annonceform = $this->createForm(AnnonceType::class, $annonce);

        //permet d'extraire les données de la requête
        $annonceform->handleRequest($request);

        if($annonceform -> isSubmitted() && $annonceform -> isValid()) {
            //traitement de la donnée + récupération des champs non mapped

            //enregistrement de l'annonce dans la BDD
            $annonceRepository->save($annonce, true);

            //redirige vers une page de confirmation
            $this->addFlash('success', 'Votre demande a été validée.');
            return $this -> redirectToRoute('annonce_add');

        }

        return $this->render('annonce/add.html.twig', [
            'annonceForm' => $annonceform->createView()
        ]);
    }

    #[Route('/list', name: 'list')]
    public function list(AnnonceRepository $annonceRepository): Response
    {
        $annonces = $annonceRepository->findAll();
        return $this->render('annonce/list.html.twig', [
            'annonces' => $annonces
        ]);
    }

    #[Route('/detail/{id}', name: 'show', requirements : ["id" => "\d+"])]
    public function show(int $id,
                         AnnonceRepository $annonceRepository,
                         UserRepository $userRepository): Response
    {
        //Renvoyer le détail d'une annonce
        $annonce = $annonceRepository->find($id);

        if (!$annonce) {
            //si l'annonce n'est pas trouvé, page d'erreur
            throw $this->createNotFoundException("Cette annonce n'a pas été trouvée.");
        }
        return $this->render('annonce/show.html.twig', [
            'annonce' => $annonce
        ]);
    }

    #[Route('/update/{id}', name: 'update', requirements: ['id' => '\d+'])]
    public function update(int $id): Response
    {
        return $this->render('annonce/update.html.twig');
    }

    #[Route('/delete/{id}', name: 'delete', requirements: ['id' => '\d+'])]
    public function delete(int $id): Response
    {
        return $this->render('annonce/list.html.twig');
    }
}
