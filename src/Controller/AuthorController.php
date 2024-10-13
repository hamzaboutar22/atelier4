<?php

namespace App\Controller;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }

    #[Route('/author/list', name: 'app_author_list')]
    public function listAuthors(){(ManagerRegistry $manager): Response
    {
        $author = new Author();
        $author->setName("New Author");

        $em = $manager->getManager();
        $em->persist($author);
        $em->flush();

        return new Response("Author added.");
    }

    #[Route(path: '/author/update/{id}', name: 'app_author_update')]
    public function updateAuthor($id, ManagerRegistry $manager, AuthorRepository $repo): Response
    {
        $author = $repo->find($id);
        if (!$author) {
            return new Response('Author not found', 404);
        }

        $author->setName('Updated Author');
        $em = $manager->getManager();
        $em->flush();

        return new Response("Author updated.");
    }

    

    
}
