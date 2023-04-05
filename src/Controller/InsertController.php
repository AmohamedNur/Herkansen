<?php

namespace App\Controller;


use App\Entity\Genre;
use App\Form\InsertType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InsertController extends AbstractController
{
    #[Route('/insert', name: 'insert')]
    public function insert(Request $request, EntityManagerInterface $em):Response
    {
        $genre=new Genre();

        $form=$this->createForm(InsertType::class,$genre);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $genre=$form->getData();
            $em->persist($genre);
            $em->flush();

            $this->addFlash('success', 'Nieuwe genre toegevoegd');
//            return $this->renderForm('/home.html.twig', ['insert' => $form,]);

            return $this->redirectToRoute('home');
        }
        return $this->renderForm('/insert.html.twig', ['insert' => $form,]);
    }
}