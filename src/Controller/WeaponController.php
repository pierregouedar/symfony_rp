<?php

namespace App\Controller;

use App\Entity\Weapon;
use App\Form\WeaponFormType;
use App\Repository\WeaponRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class WeaponController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/weapon/create')]
    public function create(EntityManagerInterface $entityManager, Request $request): Response
    {
        $weapon = new Weapon();
        $form = $this->createForm(WeaponFormType::class, $weapon);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($weapon);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('weapon/create.html.twig', ['form' => $form]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/weapon')]
    public function index(WeaponRepository $weaponRepository):Response{
        $weapons = $weaponRepository->findAll();
        return $this->render('weapon/index.html.twig', ['weapons'=>$weapons]);
    }


    #[IsGranted('ROLE_ADMIN')]
    #[Route('/weapon/{id}/update', requirements: ['id' => '\d+'])]
    public function update(EntityManagerInterface $entityManager, Weapon $weapon, Request $request): \Symfony\Component\HttpFoundation\RedirectResponse|Response
    {
        $form = $this->createForm(WeaponFormType::class, $weapon);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_weapon_index');
        }

        return $this->render('weapon/update.html.twig', ['weapon' => $weapon, 'form' => $form]);
    }



}
