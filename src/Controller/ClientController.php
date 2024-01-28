<?php

namespace App\Controller;

use App\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ClientController extends AbstractController
{
    #[Route('/client', name: 'app_client')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $client = new Client();
        $client->setNom('Koffi')
                ->setPrenom('Cyriaque')        
                ->setNumero(0102570131)
                ->setAdresse('Cocody Palmeraie')        
                ->setEmail('kofficyriaque413@gmail.com');

        $entityManager->persist($client);
        $entityManager->flush();
        return $this->render('client/index.html.twig', [
            'controller_name' => 'ClientController',
            'client' => $client,
        ]);
    }
}
