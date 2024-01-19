<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\Weapon;
use App\Form\EventFormType;
use App\Form\WeaponFormType;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    #[Route('/event')]
    public function index(EventRepository $eventRepository): Response
    {
        return $this->render('event/index.html.twig', [
            'events' => $eventRepository->findAll(),
        ]);
    }

    #[Route('/event/create')]
    public function create(EntityManagerInterface $entityManager, Request $request): Response
    {
        $event = new Event();
        $form = $this->createForm(EventFormType::class, $event);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $event->setDate(new \DateTime());
            $event->setResult(rand(0, 20));
            $entityManager->persist($event);
            $entityManager->flush();

            return $this->redirectToRoute('app_event_show', ['id'=>$event->getId()]);
        }

        return $this->render('event/create.html.twig', ['form' => $form]);
    }

    #[Route('/event/{id}/show', requirements: ['id' => '\d+'])]
    public function show(Event $event){
        return $this->render('event/show.html.twig', ['event'=>$event]);
    }
}
