<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VetController extends AbstractController
{
    /**
     * @Route("/vet", name="app_vet")
     */
    public function index(): Response
    {
        return $this->render('vet/index.html.twig', [
            'controller_name' => 'VetController',
        ]);
    }
}
