<?php

namespace App\Controller;

use App\Entity\PointAttribution;
use App\Form\Type\PointAttributionType;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PointController extends AbstractController
{
    #[Route('/point', name: 'app_point')]
    public function index(): Response
    {
        return $this->render('point/index.html.twig');
    }

    #[Route('/point/add', name: 'app_add_points')]
    public function addPoints(ManagerRegistry $doctrine, Request $request, ManagerRegistry $registry): Response
    {
        $pointAttribution = new PointAttribution();

        $form = $this->createForm(PointAttributionType::class, $pointAttribution);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $pointAttribution->setPoints($form->getData()->getPoints());
            $pointAttribution->setDate($form->getData()->getDate());

            $userRepo = new UserRepository($registry);

            // TODO select the user from the form
            $user = $userRepo->findOneById(1);

            $pointAttribution->addUser($user);

            // TODO if group is selected, add all users of this group
            // $pointAttribution->addUser($groupUser);


            $entityManager = $doctrine->getManager();
            $entityManager->persist($pointAttribution);
            $entityManager->flush();

            $this->addFlash('success', 'pointAttribution successfully created.');

        }

        return $this->renderForm('point/add.html.twig', [
            'form' => $form,
        ]);


        
    }
}
