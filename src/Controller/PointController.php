<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PointController extends AbstractController
{
    #[Route('/point', name: 'app_point')]
    public function index(): Response
    {
        return $this->render('point/index.html.twig', [
            'controller_name' => 'PointController',
        ]);
    }
}
