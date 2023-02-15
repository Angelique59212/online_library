<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Category;
use App\Repository\ShelfRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    #[Route('/book', name: 'app_book')]
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }

    #[Route('/addBook/{name_book}/{name_category}')]
    public function addBook(string $name_book, Category $category,ShelfRepository $repository): Response
    {
        $book = new Book();
        $book
            ->setNameBook($name_book)
            ->setCategory($category)
        ;
        $this->manager->persist($book);
        $this->manager->flush();

        return $this->render('home/index.html.twig', [
            'shelfs' => $repository->findAll(),
        ]);

    }
}
