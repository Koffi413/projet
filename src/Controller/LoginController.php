<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
   private $data;
   private $form;

    #[Route('/login', name: 'app_login',methods:['GET','POST'])]
    public function index(): Response
    {
        
        $this->data = new Client();
        $this->form = $this->createForm(ClientType::class , $this->data);  
        return $this->render('connexion/co.html.twig', [
            'form'=>$this->form,
        ]);
    }

    #[Route('/login/verification', name: 'app_verification',methods:['GET','POST'])]
    public function verification(ClientRepository $clientRepository, Request $request)
    {
        $this->form->handleRequest($request);
        if( $this->form->isSubmitted() && $this->form->isValid())
        {
            $info = $this->form->getData();
            $clientRepository = $clientRepository->findByClient($info);
        }
        if(!empty($clientRepository))
        {            
            return $this->redirectToRoute('app_acceuil', [
                
            ]);
        }else
        {
            $error = "Nom ou Mot de Passe Incorect";
            return $this->redirectToRoute('app_login', [
                'error' => $error
            ]);
        }
        
    }
}
