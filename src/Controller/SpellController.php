<?php

namespace App\Controller;

use App\Entity\Spell;
use App\Form\SpellFormType;
use App\Repository\SpellRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class SpellController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/spell', name: "app_spell_index")]
    public function index(SpellRepository $spellRepository):Response{
        $spells = $spellRepository->findAll();
        return $this->render('spell/index.html.twig', ['spells'=>$spells]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/spell/create')]
    public function create(EntityManagerInterface $entityManager, Request $request): Response
    {
        $spell = new Spell();
        $form = $this->createForm(SpellFormType::class, $spell);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($spell);
            $entityManager->flush();

            return $this->redirectToRoute('app_guide');
        }

        return $this->render('spell/create.html.twig', ['form' => $form]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/spell/{id}/update', requirements: ['id' => '\d+'])]
    public function update(EntityManagerInterface $entityManager, Spell $spell, Request $request): \Symfony\Component\HttpFoundation\RedirectResponse|Response
    {
        $form = $this->createForm(SpellFormType::class, $spell);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_spell_index');
        }

        return $this->render('spell/update.html.twig', ['spell' => $spell, 'form' => $form]);
    }
}
