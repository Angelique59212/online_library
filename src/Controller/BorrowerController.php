<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BorrowerController extends AbstractController
{
    #[Route('/borrower', name: 'app_borrower')]
    public function index(): Response
    {
        return $this->render('borrower/index.html.twig', [
            'controller_name' => 'BorrowerController',
        ]);
    }
}
