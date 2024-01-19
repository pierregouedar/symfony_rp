<?php

namespace App\Controller;

use App\Entity\Entity;
use App\Entity\Picture;
use App\Entity\Weapon;
use App\Form\EntityFormType;
use App\Form\WeaponFormType;
use App\Repository\EntityRepository;
use App\Repository\GearRepository;
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
                if (null !== $form->get('picture')->getData()) {
                    $picture = new Picture();
                    $picture->setPicture(file_get_contents($form->get('picture')->getData()));
                    $entityManager->persist($picture);
                    $entity->setPicture($picture);
                }
                $this->getUser()->setEntity($entity); // Ajoute l'entité à l'utilisateur connecté
                $entity->setHp($entity->getmaxHp());
                $entityManager->persist($entity);
                $entityManager->flush();

                return $this->redirectToRoute('app_guide');
            }

            return $this->render('entity/create.html.twig', ['form' => $form]);
        }
        return $this->redirectToRoute('app_home');
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/entity')]
    public function index(EntityRepository $entityRepository):Response{
        $entities = $entityRepository->findAll();
        return $this->render('entity/index.html.twig', ['entities'=>$entities]);
    }
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/entity/{id}/update', requirements: ['id' => '\d+'])]
    public function update(EntityManagerInterface $entityManager, Entity $entity, Request $request): \Symfony\Component\HttpFoundation\RedirectResponse|Response
    {
        $form = $this->createForm(EntityFormType::class, $entity);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (null === $entity->getPicture()) {
                if (null !== $form->get('picture')->getData()) {
                    $image = new Picture();
                    $entity->setPicture($image);
                    $image->setPicture(file_get_contents($form->get('picture')->getData()));
                    $entityManager->persist($image);
                }
            } else {
                $image = $entity->getPicture();
                $entityManager->persist($image);
            }
            if ($entity->getHp() > $entity->getMaxHp()){
                $entity->setHp($entity->getmaxHp());
            }
            $entityManager->flush();

            return $this->redirectToRoute('app_entity_index');
        }

        return $this->render('entity/update.html.twig', ['entity' => $entity, 'form' => $form]);
    }

    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    #[Route('/entity/{id}/show', requirements: ['id' => '\d+'])]
    public function show(int $id, EntityRepository $entityRepository):Response{
        if ($id == $this->getUser()->getEntity()->getId() or $this->getUser()->getRoles()[0]=="ROLE_ADMIN"){
            return $this->render('entity/show.html.twig', ['entity'=>$entityRepository->findById($id)[0]]);
        }
        return $this->redirectToRoute('app_guide');
    }

    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    #[Route('/entity/weapons')]
    public function weapons():Response{
        return $this->render('entity/weapons.html.twig', ['entity'=>$this->getUser()->getEntity()]);
    }

    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    #[Route('/entity/spells')]
    public function spells():Response{
        return $this->render('entity/spells.html.twig', ['entity'=>$this->getUser()->getEntity()]);
    }

    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    #[Route('/entity/gear')]
    public function gear():Response{
        return $this->render('entity/gear.html.twig', ['entity'=>$this->getUser()->getEntity()]);
    }
}
