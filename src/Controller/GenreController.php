<?php

namespace App\Controller;
use App\Entity\Genre;
use App\Form\InsertType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GenreController extends  AbstractController{
    #[Route('/home', name: 'home')]
    public function home(ManagerRegistry $doctrine): Response
    {
        $genre=$doctrine->getRepository(Genre::class)->findAll();
        return $this->render('/home.html.twig',
            ['genre'=>$genre]);
    }

    #[Route('/movie/{id}', name: 'movie')]

    public function genre(ManagerRegistry $doctrine, int $id): Response
    {
        $genre = $doctrine->getRepository(Genre::class)->find($id);

        return $this->render('/movies.html.twig',
            ['genre' => $genre  ]);}

}