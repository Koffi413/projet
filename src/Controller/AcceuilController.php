<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MaisonsRepository;
use App\search;
use App\searchform;
use Symfony\Component\Form\Extension\Core\Type\TextType; // Importer TextType
use Symfony\Component\HttpFoundation\Request;

class AcceuilController extends AbstractController
{
    #[Route('/', name: 'app_acceuil')]
    public function index(MaisonsRepository $maisonsRepository, Request $request): Response
    {   
        $maisons = $maisonsRepository->findAll();

        return $this->render('acceuil/index.html.twig', [
            'maisons' => $maisons,
        ]);
    }
}
