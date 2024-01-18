<?php

namespace App\Controller;

use App\Entity\Entity;
use App\Form\EntityFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class EntityController extends AbstractController
{
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    #[Route('/entity/create')]
    public function create(EntityManagerInterface $entityManager, Request $request): Response
    {
        if ($this->getUser()->getEntity()===null){ // Si aucune entité est lié à l'utilisateur connecté
            $entity = new Entity();
            $form = $this->createForm(EntityFormType::class, $entity);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $this->getUser()->setEntity($entity); // Ajoute l'entité à l'utilisateur connecté
                $entityManager->persist($entity);
                $entityManager->flush();

                return $this->redirectToRoute('app_guide');
            }

            return $this->render('entity/create.html.twig', ['form' => $form]);
        }
        return $this->redirectToRoute('app_home');
    }

    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    #[Route('/entity/show')]
    public function show():Response{
        return $this->render('entity/show.html.twig', ['entity'=>$this->getUser()->getEntity()]);
    }
}
