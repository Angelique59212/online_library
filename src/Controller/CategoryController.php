<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Shelf;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{

    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }
    #[Route('/category', name: 'app_category')]
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    #[Route('/addCategory/{name_category}/{id}')]
    public function addCategory(string $name_category, Shelf $shelf): Response
    {
        $category = new Category();
        $category
            ->setNameCategory($name_category)
            ->setShelf($shelf)
            ;
        $this->manager->persist($category);
        $this->manager->flush();

        return $this->render('home/index.html.twig');

    }
}
