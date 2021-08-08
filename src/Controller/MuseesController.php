<?php

namespace App\Controller;

use App\Entity\Musees;
use App\Form\MuseesType;
use App\Repository\MuseesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/musees")
 */
class MuseesController extends AbstractController
{
    /**
     * @Route("/", name="musees_index", methods={"GET"})
     */
    public function index(MuseesRepository $museesRepository): Response
    {
        return $this->render('musees/index.html.twig', [
            'musees' => $museesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="musees_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $musee = new Musees();
        $form = $this->createForm(MuseesType::class, $musee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($musee);
            $entityManager->flush();

            return $this->redirectToRoute('musees_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('musees/new.html.twig', [
            'musee' => $musee,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="musees_show", methods={"GET"})
     */
    public function show(Musees $musee): Response
    {
        return $this->render('musees/show.html.twig', [
            'musee' => $musee,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="musees_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Musees $musee): Response
    {
        $form = $this->createForm(MuseesType::class, $musee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('musees_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('musees/edit.html.twig', [
            'musee' => $musee,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="musees_delete", methods={"POST"})
     */
    public function delete(Request $request, Musees $musee): Response
    {
        if ($this->isCsrfTokenValid('delete'.$musee->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($musee);
            $entityManager->flush();
        }

        return $this->redirectToRoute('musees_index', [], Response::HTTP_SEE_OTHER);
    }
}
