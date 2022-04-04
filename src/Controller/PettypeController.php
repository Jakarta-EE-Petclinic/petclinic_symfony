<?php

namespace App\Controller;

use App\Entity\Pettype;
use App\Form\PettypeType;
use App\Repository\PettypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pettype")
 */
class PettypeController extends AbstractController
{
    /**
     * @Route("/", name="app_pettype_index", methods={"GET"})
     */
    public function index(PettypeRepository $pettypeRepository): Response
    {
        return $this->render('pettype/index.html.twig', [
            'pettypes' => $pettypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_pettype_new", methods={"GET", "POST"})
     */
    public function new(Request $request, PettypeRepository $pettypeRepository): Response
    {
        $pettype = new Pettype();
        $form = $this->createForm(PettypeType::class, $pettype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pettypeRepository->add($pettype);
            return $this->redirectToRoute('app_pettype_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pettype/new.html.twig', [
            'pettype' => $pettype,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_pettype_show", methods={"GET"})
     */
    public function show(Pettype $pettype): Response
    {
        return $this->render('pettype/show.html.twig', [
            'pettype' => $pettype,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_pettype_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Pettype $pettype, PettypeRepository $pettypeRepository): Response
    {
        $form = $this->createForm(PettypeType::class, $pettype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pettypeRepository->add($pettype);
            return $this->redirectToRoute('app_pettype_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pettype/edit.html.twig', [
            'pettype' => $pettype,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_pettype_delete", methods={"POST"})
     */
    public function delete(Request $request, Pettype $pettype, PettypeRepository $pettypeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pettype->getId(), $request->request->get('_token'))) {
            $pettypeRepository->remove($pettype);
        }

        return $this->redirectToRoute('app_pettype_index', [], Response::HTTP_SEE_OTHER);
    }
}
