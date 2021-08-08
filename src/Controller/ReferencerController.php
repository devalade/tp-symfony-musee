<?php

namespace App\Controller;

use App\Entity\Referencer;
use App\Form\ReferencerType;
use App\Repository\ReferencerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/referencer")
 */
class ReferencerController extends AbstractController
{
    /**
     * @Route("/", name="referencer_index", methods={"GET"})
     */
    public function index(ReferencerRepository $referencerRepository): Response
    {
        return $this->render('referencer/index.html.twig', [
            'referencers' => $referencerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="referencer_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $referencer = new Referencer();
        $form = $this->createForm(ReferencerType::class, $referencer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($referencer);
            $entityManager->flush();

            return $this->redirectToRoute('referencer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('referencer/new.html.twig', [
            'referencer' => $referencer,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="referencer_show", methods={"GET"})
     */
    public function show(Referencer $referencer): Response
    {
        return $this->render('referencer/show.html.twig', [
            'referencer' => $referencer,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="referencer_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Referencer $referencer): Response
    {
        $form = $this->createForm(ReferencerType::class, $referencer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('referencer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('referencer/edit.html.twig', [
            'referencer' => $referencer,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="referencer_delete", methods={"POST"})
     */
    public function delete(Request $request, Referencer $referencer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$referencer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($referencer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('referencer_index', [], Response::HTTP_SEE_OTHER);
    }
}
