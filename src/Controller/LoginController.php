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

    #[Route('/login', name: 'app_login')]
    public function index(ClientRepository $clientRepository, Request $request): Response
    {
        $this->data = new Client();
        $this->form = $this->createForm(ClientType::class , $this->data);  
        
        $this->form->handleRequest($request);
        if( $this->form->isSubmitted() && $this->form->isValid())
        {
            $info = $this->form->getData();
            $clientRepository = $clientRepository->findByClient($info);
            if (!empty($clientRepository)) {
                return $this->redirectToRoute('app_acceuil');
            }else{
                $error = "Nom ou Mot de Passe Incorect";
                return $this->redirectToRoute('app_login',[
                    'error'=> $error
                ]);
            }
        }
        return $this->render('connexion/co.html.twig', [
            'form'=>$this->form,
        ]);
    }

   // #[Route( name: 'app_verification',methods:['GET','POST'])]
    //public function verification()
    //{
      //  $datas=$this->data;
        //if( $this->form->isSubmitted() && $this->form->isValid())
        //{
         //   $info = $this->form->getData();
          //  $clientRepository = $clientRepository->findByClient($info);
        //}
        //if(!empty($clientRepository))
        //{
          //  $error = "Nom ou Mot de Passe Incorect";
           // return $this->redirectToRoute('app_acceuil', [
            //]);
        //}   
        
    //}
}
