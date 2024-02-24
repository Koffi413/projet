<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MaisonsRepository;
use App\Entity\Maisons;

class MaisonsController extends AbstractController
{
    #[Route('/maisons', name: 'app_maisons')]
    public function index(MaisonsRepository $maisonsRepository): Response
    {
        $maisons = $maisonsRepository->findByDisponibilite(1);
        return $this->render('maisons/index.html.twig', [
            'maisons' => $maisons,
        ]);
    }
}
