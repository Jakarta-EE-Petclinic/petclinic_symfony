<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PetTypeController extends AbstractController
{
    /**
     * @Route("/pet/type", name="app_pet_type")
     */
    public function index(): Response
    {
        return $this->render('pet_type/index.html.twig', [
            'controller_name' => 'PetTypeController',
        ]);
    }
}
