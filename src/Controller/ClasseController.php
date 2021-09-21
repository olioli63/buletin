<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Form\ClasseType;
use App\Repository\ClasseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/classe")
 */
class ClasseController extends AbstractController
{
    /**
     * @Route("/", name="classe")
     */
    public function index(ClasseRepository $classeRepository): Response
    {
        return $this->render('classe/index.html.twig', [
            'classes' => $classeRepository->findAll()
        ]);
    }
    
    /**
     * @Route("/new", name="classe_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $classe= new Classe();
        $form=$this->createForm(ClasseType:: class, $classe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em=$this->getDoctrine()->getManager();
            $em->persist($classe);
            $em->flush();
            return $this->redirectToRoute('classe');
        }
        return $this->renderForm('classe/new.html.twig', [
            'classe'=>$classe,
            'form'=>$form
        ]);
    }
    /**
     * @Route ("/{id}", name="classe_show", methods={"GET"})
     */
    public function show(Classe $classe): Response
    {
        return $this->render('classe/show.html.twig', [
            'classe'=>$classe
        ]);
    }
    /**
     * @Route("/{id}/edit", name="classe_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Classe $classe): Response
    {
        $form = $this->createForm(ClasseType:: class, $classe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('classe');
        }
        return $this->renderForm('classe/edit.html.twig', [
            'classe'=> $classe,
            'form'=> $form
        ]);
    }
    /**
     * @Route("/{id}", name="classe_delete", methods={"POST"})
     */
    public function delete(Request $request, Classe $classe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$classe->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($classe);
            $em->flush();
        }

        return $this->redirectToRoute('classe', [], Response::HTTP_SEE_OTHER);
    }
}
