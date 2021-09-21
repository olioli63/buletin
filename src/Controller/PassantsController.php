<?php

namespace App\Controller;

use App\Entity\Passants;
use App\Form\PassantsType;
use App\Repository\PassantsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/passants")
 */
class PassantsController extends AbstractController
{
    /**
     * @Route("/", name="passants_index", methods={"GET"})
     */
    public function index(PassantsRepository $passantsRepository): Response
    {
        return $this->render('passants/index.html.twig', [
            'passants' => $passantsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="passants_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $passant = new Passants();
        $form = $this->createForm(PassantsType::class, $passant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($passant);
            $entityManager->flush();

            return $this->redirectToRoute('passants_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('passants/new.html.twig', [
            'passant' => $passant,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="passants_show", methods={"GET"})
     */
    public function show(Passants $passant): Response
    {
        return $this->render('passants/show.html.twig', [
            'passant' => $passant,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="passants_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Passants $passant): Response
    {
        $form = $this->createForm(PassantsType::class, $passant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('passants_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('passants/edit.html.twig', [
            'passant' => $passant,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="passants_delete", methods={"POST"})
     */
    public function delete(Request $request, Passants $passant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$passant->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($passant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('passants_index', [], Response::HTTP_SEE_OTHER);
    }
}
