<?php

namespace App\Controller;

use App\Repository\ClientRepository;
use App\Entity\Client;
use App\Form\ClientType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Request;


class ConnexionController extends AbstractController
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    #[Route('/connexion', name: 'app_connexion')]
    public function connexion(AuthenticationUtils $authenticationUtils, ClientRepository $clientRepository, ): Response
    {
      
        
        // Récuperer l'erreur si y'en a une
        // $error = $authenticationUtils->getLastAuthenticationError();
         // le dernier nom d'utilisateur saisit par l'utilisateur
        
        return $this->redirectToRoute('app_acceuil');
    }
    private function getRequest(): Request
    {
        $request = $this->requestStack->getCurrentRequest();
        if (null === $request) {
            throw new \LogicException('Request should exist so it can be processed for error.');
        }

        return $request;
    }
}
