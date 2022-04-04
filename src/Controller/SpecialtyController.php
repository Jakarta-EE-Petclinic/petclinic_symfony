<?php

namespace App\Controller;

use App\Entity\Specialty;
use App\Form\SpecialtyType;
use App\Repository\SpecialtyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/specialty")
 */
class SpecialtyController extends AbstractController
{
    /**
     * @Route("/", name="app_specialty_index", methods={"GET"})
     */
    public function index(SpecialtyRepository $specialtyRepository): Response
    {
        return $this->render('specialty/index.html.twig', [
            'specialties' => $specialtyRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_specialty_new", methods={"GET", "POST"})
     */
    public function new(Request $request, SpecialtyRepository $specialtyRepository): Response
    {
        $specialty = new Specialty();
        $form = $this->createForm(SpecialtyType::class, $specialty);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $specialtyRepository->add($specialty);
            return $this->redirectToRoute('app_specialty_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('specialty/new.html.twig', [
            'specialty' => $specialty,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_specialty_show", methods={"GET"})
     */
    public function show(Specialty $specialty): Response
    {
        return $this->render('specialty/show.html.twig', [
            'specialty' => $specialty,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_specialty_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Specialty $specialty, SpecialtyRepository $specialtyRepository): Response
    {
        $form = $this->createForm(SpecialtyType::class, $specialty);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $specialtyRepository->add($specialty);
            return $this->redirectToRoute('app_specialty_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('specialty/edit.html.twig', [
            'specialty' => $specialty,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_specialty_delete", methods={"POST"})
     */
    public function delete(Request $request, Specialty $specialty, SpecialtyRepository $specialtyRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$specialty->getId(), $request->request->get('_token'))) {
            $specialtyRepository->remove($specialty);
        }

        return $this->redirectToRoute('app_specialty_index', [], Response::HTTP_SEE_OTHER);
    }
}
