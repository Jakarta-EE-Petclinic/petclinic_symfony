<?php

namespace App\Controller;

use App\Entity\PetType;
use App\Form\PetTypeType;
use App\Repository\PetTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pet/type")
 */
class PetTypeController extends AbstractController
{
    /**
     * @Route("/", name="app_pet_type_index", methods={"GET"})
     */
    public function index(PetTypeRepository $petTypeRepository): Response
    {
        return $this->render('pet_type/index.html.twig', [
            'pet_types' => $petTypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_pet_type_new", methods={"GET", "POST"})
     */
    public function new(Request $request, PetTypeRepository $petTypeRepository): Response
    {
        $petType = new PetType();
        $form = $this->createForm(PetTypeType::class, $petType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $petTypeRepository->add($petType);
            return $this->redirectToRoute('app_pet_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pet_type/new.html.twig', [
            'pet_type' => $petType,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_pet_type_show", methods={"GET"})
     */
    public function show(PetType $petType): Response
    {
        return $this->render('pet_type/show.html.twig', [
            'pet_type' => $petType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_pet_type_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, PetType $petType, PetTypeRepository $petTypeRepository): Response
    {
        $form = $this->createForm(PetTypeType::class, $petType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $petTypeRepository->add($petType);
            return $this->redirectToRoute('app_pet_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pet_type/edit.html.twig', [
            'pet_type' => $petType,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_pet_type_delete", methods={"POST"})
     */
    public function delete(Request $request, PetType $petType, PetTypeRepository $petTypeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$petType->getId(), $request->request->get('_token'))) {
            $petTypeRepository->remove($petType);
        }

        return $this->redirectToRoute('app_pet_type_index', [], Response::HTTP_SEE_OTHER);
    }
}
