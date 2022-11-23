<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Type\UserType;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/user/add', name: 'app_add_user')]
    public function addUser(ManagerRegistry $doctrine, Request $request): Response
    {

        $user = new User();
        $user->setCreationDate(new DateTime());
        $user->setPoints(0);

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user->setName($form->getData()->getName());

            $entityManager = $doctrine->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'user successfully created.');

        }

            

        return $this->renderForm('user/add.html.twig', [
            'form' => $form,
        ]);


        



    }
}
