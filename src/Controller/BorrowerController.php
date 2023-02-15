<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Borrower;
use App\Repository\ShelfRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BorrowerController extends AbstractController
{
    private EntityManagerInterface $manager;

    /**
     * @param EntityManagerInterface $manager
     */
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @return Response
     */
    #[Route('/borrower', name: 'app_borrower')]
    public function index(): Response
    {
        return $this->render('borrower/index.html.twig', [
            'controller_name' => 'BorrowerController',
        ]);
    }

    /**
     * @param string $firstname
     * @return Response
     */
    #[Route('/addBorrower/{firstname}')]
    public function addBorrower(string $firstname): Response
    {
        $borrower = new Borrower();
        $borrower
            ->setFirstname($firstname)
        ;
        $this->manager->persist($borrower);
        $this->manager->flush();

        return $this->render('home/index.html.twig');
    }

    /**
     * @param Borrower $borrower
     * @param Book $book
     * @return Response
     */
    #[Route('/borrow/{borrower}/{id}')]

    public function borrow(Borrower $borrower, Book $book, ShelfRepository $repository): Response
    {
        if ($book->getBorrower()!== null) {
            dd('Le livre est déjà emprunté');
        }
        $book->setBorrower($borrower);

        $this->manager->flush();

        return $this->render('home/index.html.twig', [
            'shelfs' => $repository->findAll(),
        ]);
    }
}
