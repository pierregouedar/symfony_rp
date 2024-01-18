<?php

namespace App\Controller;

use App\Entity\Gear;
use App\Form\GearFormType;
use App\Repository\GearRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class GearController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/gear')]
    public function index(GearRepository $gearRepository):Response{
        $gears = $gearRepository->findAll();
        return $this->render('gear/index.html.twig', ['gears'=>$gears]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/gear/create')]
    public function create(EntityManagerInterface $entityManager, Request $request): Response
    {
        $gear = new Gear();
        $form = $this->createForm(GearFormType::class, $gear);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($gear);
            $entityManager->flush();

            return $this->redirectToRoute('app_guide');
        }

        return $this->render('gear/create.html.twig', ['form' => $form]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/gear/{id}/update', requirements: ['id' => '\d+'])]
    public function update(EntityManagerInterface $entityManager, Gear $gear, Request $request): \Symfony\Component\HttpFoundation\RedirectResponse|Response
    {
        $form = $this->createForm(GearFormType::class, $gear);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_gear_index');
        }

        return $this->render('gear/update.html.twig', ['gear' => $gear, 'form' => $form]);
    }
}
