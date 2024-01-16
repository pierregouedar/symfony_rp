<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SpellController extends AbstractController
{
    #[Route('/spell/create')]
    public function create(): Response
    {
        return $this->render('spell/index.html.twig', [
            'controller_name' => 'SpellController',
        ]);
    }
}
