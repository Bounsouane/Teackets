<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Form\TicketType;
use App\Repository\TicketRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/ticket', name : 'ticket_')]
class TicketController extends AbstractController
{
    #[Route('/', name: '')]
    public function index(): Response
    {
        return $this->render('ticket/index.html.twig');
    }


    #[Route('/add', name: 'add')]
    public function add(Request $request,
                        TicketRepository $ticketRepository,
                        UserRepository $userRepository): Response
    {

        $ticket = new Ticket();

        $user = new User();
        //instanciation du formulaire en lui passant l'instance de user et de ticket


        $ticketform = $this->createForm(TicketType::class, $ticket);

        //permet d'extraire les données de la requête

        $ticketform->handleRequest($request);


        if($ticketform -> isSubmitted() && $ticketform -> isValid()) {
            //traitement de la donnée + récupération des champs non mapped
            $ticket->setDateOuverture(new \DateTime());
            $ticket->setStatut("A traiter");
            $user = $ticket->getUsers();
            $ticket->addUser($user);

            //Configurer le délai, soumettre idée à Gaël

            //enregistrement du ticket dans la BDD
            $ticketRepository->save($ticket, true);

            //redirige vers une page de confirmation
            $this->addFlash('success', 'Votre demande a été validée.');
            return $this -> redirectToRoute('ticket_add');

        }

        return $this->render('ticket/add.html.twig', [
            'ticketForm' => $ticketform->createView(),
        ]);
    }

    #[Route('/list', name: 'list')]
    public function list(TicketRepository $ticketRepository, UserRepository $userRepository): Response
    {
        $tickets = $ticketRepository->findAll();
        return $this->render('ticket/list.html.twig', [
            'tickets' => $tickets
        ]);
    }

    #[Route('/detail/{id}', name: 'show', requirements : ["id" => "\d+"])]
    public function show(int $id,
                         TicketRepository $ticketRepository,
                         UserRepository $userRepository): Response
    {
        //Renvoyer le détail d'un ticket et d'un user
        $ticket = $ticketRepository->find($id);

        if (!$ticket) {
            //si le ticket n'est pas trouvé, page d'erreur
            throw $this->createNotFoundException("Ce ticket n'a pas été trouvé.");
        }

        return $this->render('ticket/show.html.twig', [
            'ticket' => $ticket
        ]);
    }

    #[Route('/update/{id}', name: 'update', requirements: ['id' => '\d+'])]
    public function update(int $id): Response
    {
        return $this->render('ticket/update.html.twig');
    }

    #[Route('/delete/{id}', name: 'delete', requirements: ['id' => '\d+'])]
    public function delete(int $id): Response
    {
        return $this->render('ticket/list.html.twig');
    }

}
