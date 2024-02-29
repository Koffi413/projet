<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MaisonsRepository;

class AcceuilController extends AbstractController
{
    #[Route('/', name: 'app_acceuil')]
    public function index(MaisonsRepository $maisonsRepository): Response
    {
        $maisons = $maisonsRepository->findAll();
        return $this->render('acceuil/index.html.twig', [
            'maisons' => $maisons,
        ]);
    }
}
