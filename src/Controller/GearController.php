<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GearController extends AbstractController
{
    #[Route('/gear/create')]
    public function create(): Response
    {
        return $this->render('gear/index.html.twig', [
            'controller_name' => 'GearController',
        ]);
    }
}
