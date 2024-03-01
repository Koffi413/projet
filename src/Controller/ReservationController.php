<?php

namespace App\Controller;

use App\Repository\MaisonsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;


class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation')]
    public function index(SessionInterface $session ,MaisonsRepository $maisonsRepository): Response
    {
        $reserver = $session->get('reserver', []);
        $allReservation = [];

        foreach($reserver as $id => $quantité) {
            $allReservation [] = [
                'maisons' => $maisonsRepository->find($id),
                'quantité' =>$quantité
            ]; 
        }
        return $this->render('reservation/panier.html.twig', [
            'panier' => $allReservation,
        ]);
    }


    #[Route('(/reservation/ajouter/{id})', name: 'reservation_ajouter')]
    public function ajouter($id, SessionInterface $session){
        $reserver = $session->get('reserver', []);
        if (!empty($reserver[$id])){
            $reserver[$id]++;
        }else{
        $reserver[$id] = 1;
        }
        $session->set('reserver', $reserver);
        dd($session->get('reserver'));
    }
}
