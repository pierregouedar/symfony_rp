<?php

namespace App\Controller;

use App\Entity\Weapon;
use App\Form\EntityFormType;
use App\Form\WeaponFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class WeaponController extends AbstractController
{
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    #[Route('/weapon/create')]
    public function create(EntityManagerInterface $entityManager, Request $request): Response
    {
        $weapon = new Weapon();
        $form = $this->createForm(WeaponFormType::class, $weapon);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $weapon->setEntity($this->getUser()->getEntity()); // Ajoute automatiquement l'arme à l'entité de l'utilisateur connecté
            $entityManager->persist($weapon);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('weapon/create.html.twig', ['form' => $form]);
    }
}
