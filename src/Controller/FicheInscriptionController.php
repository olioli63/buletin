<?php

namespace App\Controller;

use App\Entity\FicheInscription;
use App\Form\FicheInscriptionType;
use App\Repository\FicheInscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/fiche/inscription")
 */
class FicheInscriptionController extends AbstractController
{
    /**
     * @Route("/", name="fiche_inscription_index", methods={"GET"})
     */
    public function index(FicheInscriptionRepository $ficheInscriptionRepository): Response
    {
        return $this->render('fiche_inscription/index.html.twig', [
            'fiche_inscriptions' => $ficheInscriptionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="fiche_inscription_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ficheInscription = new FicheInscription();
        $form = $this->createForm(FicheInscriptionType::class, $ficheInscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ficheInscription);
            $entityManager->flush();

            return $this->redirectToRoute('fiche_inscription_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('fiche_inscription/new.html.twig', [
            'fiche_inscription' => $ficheInscription,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="fiche_inscription_show", methods={"GET"})
     */
    public function show(FicheInscription $ficheInscription): Response
    {
        return $this->render('fiche_inscription/show.html.twig', [
            'fiche_inscription' => $ficheInscription,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="fiche_inscription_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, FicheInscription $ficheInscription): Response
    {
        $form = $this->createForm(FicheInscriptionType::class, $ficheInscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fiche_inscription_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('fiche_inscription/edit.html.twig', [
            'fiche_inscription' => $ficheInscription,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="fiche_inscription_delete", methods={"POST"})
     */
    public function delete(Request $request, FicheInscription $ficheInscription): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ficheInscription->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ficheInscription);
            $entityManager->flush();
        }

        return $this->redirectToRoute('fiche_inscription_index', [], Response::HTTP_SEE_OTHER);
    }
}
