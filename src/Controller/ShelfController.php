<?php

namespace App\Controller;

use App\Entity\Shelf;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShelfController extends AbstractController
{
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }
    #[Route('/shelf', name: 'app_shelf')]
    public function index(): Response
    {
        return $this->render('shelf/index.html.twig', [
            'controller_name' => 'ShelfController',
        ]);
    }

    #[Route('/addShelf/{name}')]
    public function addShelf(string $name): Response
    {
        $shelf = new Shelf();
        $shelf
            ->setName($name)
        ;
        $this->manager->persist($shelf);
        $this->manager->flush();

        return $this->render('home/index.html.twig');
    }
}
