<?php

namespace App\Controller;

use App\Entity\Visiter;
use App\Form\VisiterType;
use App\Repository\VisiterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/visiter")
 */
class VisiterController extends AbstractController
{
    /**
     * @Route("/", name="visiter_index", methods={"GET"})
     */
    public function index(VisiterRepository $visiterRepository): Response
    {
        return $this->render('visiter/index.html.twig', [
            'visiters' => $visiterRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="visiter_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $visiter = new Visiter();
        $form = $this->createForm(VisiterType::class, $visiter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($visiter);
            $entityManager->flush();

            return $this->redirectToRoute('visiter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('visiter/new.html.twig', [
            'visiter' => $visiter,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="visiter_show", methods={"GET"})
     */
    public function show(Visiter $visiter): Response
    {
        return $this->render('visiter/show.html.twig', [
            'visiter' => $visiter,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="visiter_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Visiter $visiter): Response
    {
        $form = $this->createForm(VisiterType::class, $visiter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('visiter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('visiter/edit.html.twig', [
            'visiter' => $visiter,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="visiter_delete", methods={"POST"})
     */
    public function delete(Request $request, Visiter $visiter): Response
    {
        if ($this->isCsrfTokenValid('delete'.$visiter->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($visiter);
            $entityManager->flush();
        }

        return $this->redirectToRoute('visiter_index', [], Response::HTTP_SEE_OTHER);
    }
}
