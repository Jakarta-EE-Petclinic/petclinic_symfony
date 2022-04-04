<?php

namespace App\Controller;

use App\Entity\Pettype;
use App\Form\PettypeType;
use Doctrine\ORM\EntityManagerInterface;
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
    public function index(EntityManagerInterface $entityManager): Response
    {
        $pettypes = $entityManager
            ->getRepository(Pettype::class)
            ->findAll();

        return $this->render('pettype/index.html.twig', [
            'pettypes' => $pettypes,
        ]);
    }

    /**
     * @Route("/new", name="app_pettype_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $pettype = new Pettype();
        $form = $this->createForm(PettypeType::class, $pettype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($pettype);
            $entityManager->flush();

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
    public function edit(Request $request, Pettype $pettype, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PettypeType::class, $pettype);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

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
    public function delete(Request $request, Pettype $pettype, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pettype->getId(), $request->request->get('_token'))) {
            $entityManager->remove($pettype);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_pettype_index', [], Response::HTTP_SEE_OTHER);
    }
}
