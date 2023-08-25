<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/professeur', name : 'professeur_')]
class ProfController extends AbstractController
{
    #[Route('/', name: '')]
    public function index(): Response
    {
        return $this->render('prof/index.html.twig');
    }

    #[Route('/add', name: 'add')]
    public function add(): Response
    {
        return $this->render('prof/add.html.twig');
    }

    #[Route('/list', name: 'list')]
    public function list(): Response
    {
        return $this->render('prof/list.html.twig');
    }

    #[Route('/detail/{id}', name: 'show', requirements : ["id" => "\d+"])]
    public function show(int $id): Response
    {
        return $this->render('prof/show.html.twig');
    }

    #[Route('/update/{id}', name: 'update', requirements: ['id' => '\d+'])]
    public function update(int $id): Response
    {
        return $this->render('prof/update.html.twig');
    }

    #[Route('/delete/{id}', name: 'delete', requirements: ['id' => '\d+'])]
    public function delete(int $id): Response
    {
        return $this->render('prof/list.html.twig');
    }
}
