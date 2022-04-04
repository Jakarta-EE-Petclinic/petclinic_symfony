<?php

namespace App\Controller;

use App\Entity\Vet;
use App\Form\VetType;
use App\Repository\VetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/vet")
 */
class VetController extends AbstractController
{
    /**
     * @Route("/", name="app_vet_index", methods={"GET"})
     */
    public function index(VetRepository $vetRepository): Response
    {
        return $this->render('vet/index.html.twig', [
            'vets' => $vetRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_vet_new", methods={"GET", "POST"})
     */
    public function new(Request $request, VetRepository $vetRepository): Response
    {
        $vet = new Vet();
        $form = $this->createForm(VetType::class, $vet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vetRepository->add($vet);
            return $this->redirectToRoute('app_vet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('vet/new.html.twig', [
            'vet' => $vet,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_vet_show", methods={"GET"})
     */
    public function show(Vet $vet): Response
    {
        return $this->render('vet/show.html.twig', [
            'vet' => $vet,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_vet_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Vet $vet, VetRepository $vetRepository): Response
    {
        $form = $this->createForm(VetType::class, $vet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vetRepository->add($vet);
            return $this->redirectToRoute('app_vet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('vet/edit.html.twig', [
            'vet' => $vet,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_vet_delete", methods={"POST"})
     */
    public function delete(Request $request, Vet $vet, VetRepository $vetRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vet->getId(), $request->request->get('_token'))) {
            $vetRepository->remove($vet);
        }

        return $this->redirectToRoute('app_vet_index', [], Response::HTTP_SEE_OTHER);
    }
}
