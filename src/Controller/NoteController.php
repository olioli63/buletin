<?php

namespace App\Controller;

use App\Entity\FicheInscription;
use App\Entity\Matiere;
use App\Entity\Note;
use App\Form\NoteType;
use App\Repository\NoteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
* @Route("/note")
*/
class NoteController extends AbstractController
{
    /**
     * @Route("/", name="note")
     */
    public function index(NoteRepository $noteRepository): Response
    {
        return $this->render('note/index.html.twig', [
            'notes' => $noteRepository->findAll()
        ]);
    }

  

    /**
     * @Route ("/vao", name="note_vao", methods={"GET","POST"})
     */
    public function vao(Request $request): Response
    {
        $note= new Note();
        $form=$this->createForm(NoteType:: class, $note);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em= $this->getDoctrine()->getManager();
            $data= $form->getData();
            $id= $form->get('matiere')->getData();
            $idf= $form->get('IdFiche')->getData();
            $em->persist($note);
            $em->flush();
            return $this->redirectToRoute('note', [
                'matiere' => $note->getMatiere(),
                'IdFiche' => $note->getIdFiche()
            ]); 
        }
        return $this->renderForm('note/vao.html.twig', [
            'note'=> $note,
            'form'=> $form
        ]);
    }
}
