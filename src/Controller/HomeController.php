<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(AuthorizationCheckerInterface $authChecker): Response
    {
        if ($authChecker->isGranted('IS_AUTHENTICATED_FULLY')){
            return $this->render('home/index.html.twig', [
                'controller_name' => 'HomeController',
            ]);
        }
        return $this->redirectToRoute('app_login');
    }
    #[Route('/guide', name: 'app_guide')]
    public function guide(AuthorizationCheckerInterface $authChecker): Response
    {
        if ($authChecker->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->render('home/guide.html.twig');
        }
        return $this->redirectToRoute('app_register');
    }
}
