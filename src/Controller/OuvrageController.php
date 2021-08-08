<?php

namespace App\Controller;

use App\Entity\Ouvrage;
use App\Form\OuvrageType;
use App\Repository\OuvrageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ouvrage")
 */
class OuvrageController extends AbstractController
{
    /**
     * @Route("/", name="ouvrage_index", methods={"GET"})
     */
    public function index(OuvrageRepository $ouvrageRepository): Response
    {
        return $this->render('ouvrage/index.html.twig', [
            'ouvrages' => $ouvrageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ouvrage_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ouvrage = new Ouvrage();
        $form = $this->createForm(OuvrageType::class, $ouvrage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ouvrage);
            $entityManager->flush();

            return $this->redirectToRoute('ouvrage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ouvrage/new.html.twig', [
            'ouvrage' => $ouvrage,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="ouvrage_show", methods={"GET"})
     */
    public function show(Ouvrage $ouvrage): Response
    {
        return $this->render('ouvrage/show.html.twig', [
            'ouvrage' => $ouvrage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ouvrage_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ouvrage $ouvrage): Response
    {
        $form = $this->createForm(OuvrageType::class, $ouvrage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ouvrage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ouvrage/edit.html.twig', [
            'ouvrage' => $ouvrage,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="ouvrage_delete", methods={"POST"})
     */
    public function delete(Request $request, Ouvrage $ouvrage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ouvrage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ouvrage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ouvrage_index', [], Response::HTTP_SEE_OTHER);
    }
}
