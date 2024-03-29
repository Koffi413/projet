<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MaisonsRepository;
use App\Entity\Search;
use App\Entity\User;
use App\Form\SearchFormType; // Importer TextType
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Request;

class AcceuilController extends AbstractController
{
    #[Route('/', name: 'app_acceuil', methods:['GET', 'POST']
     )]
    public function index(MaisonsRepository $maisonsRepository,CategorieRepository $categorieRepository, Request $request,  User $user = null): Response
    { 

        $data = new Search();
        $categorie = $categorieRepository->findAll();
        $form = $this->createForm(SearchFormType::class, $data, [
            'categorie'=>$categorie
        ]);
        $user = $this->getUser();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $maisons = $maisonsRepository->findBySearch($task);
        } else {
            $maisons = $maisonsRepository->findAll();
        }                   
        return $this->render('acceuil/index.html.twig', [
            'maisons' => $maisons,
            'form' => $form->createView(),
            'user'=> $user
        ]);
    }
    //#[Route( '/home',name: 'app_home')]
    //public function home($user) : Response
    //{
      //  return $this->render('acceuil/index.html.twig', [
        //    'user' => $user,
        //]);
    //}
    

}
