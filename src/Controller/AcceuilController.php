<?php

namespace App\Controller;

use App\Repository\CampagneRepository;
use App\Repository\DonateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AcceuilController extends AbstractController
{
    #[Route('/acceuil', name: 'app_acceuil')]
    public function index(DonateurRepository $donateurRepository, CampagneRepository $campagneRepository): Response
    {
        return $this->render('front/index.html.twig', [
            'controller_name' => 'AcceuilController',
            'promesse_de_dons' => $donateurRepository->findAll(),
            'campagnes' => $campagneRepository->findAll()
        ]);
    }
}
