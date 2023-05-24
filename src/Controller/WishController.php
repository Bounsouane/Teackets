<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/wish', name: 'wish_')]
class WishController extends AbstractController
{
    #[Route('/', name: 'list')]
    public function list(WishRepository $wishRepository): Response
    {
        //récupération des wish publiés triés par date
        $wishes = $wishRepository->findBy(["isPublished" => true], ["dateCreated" => "DESC"]);

        return $this->render('wish/list.html.twig', [
            'wishes' => $wishes
        ]);
    }

    #[Route('/{id}', name: 'show', requirements: ["id" => "\d+"])]
    public function show(int $id, WishRepository $wishRepository): Response
    {
        $wish = $wishRepository->find($id);

        if(!$wish){
            throw $this->createNotFoundException("Oops ! Wish not found !");
        }

        return $this->render('wish/show.html.twig', [
            'wish' => $wish
        ]);
    }
    #[IsGranted('ROLE_USER')]
    #[Route('/add', name: 'add')]
    public function add(Request $request, WishRepository $wishRepository) : Response {

        /**
         * @var User $author
         */
        $author = $this->getUser();
        $wish = new Wish();
        $wish->setAuthor($author->getEmail());
        $wishForm = $this->createForm(WishType::class, $wish);

        $wishForm->handleRequest($request);

        if($wishForm->isSubmitted() && $wishForm->isValid()){

//            $wish->setDateCreated(new \DateTime());
//            $wish->setIsPublished(true);

            $wishRepository->save($wish, true);

            $this->addFlash('success', "Wish added !");

            return $this->redirectToRoute('wish_show', ['id' => $wish->getId()]);
        }

        return $this->render('wish/add.html.twig', [
            'wishForm' => $wishForm->createView()
        ]);
    }













}
