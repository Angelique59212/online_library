<?php

namespace App\Controller;

use App\Repository\ShelfRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ShelfRepository $repository): Response
    {
        return $this->render('home/index.html.twig', [
            'shelfs' => $repository->findAll(),
        ]);
    }
}
