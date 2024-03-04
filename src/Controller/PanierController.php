<?php

namespace App\Controller;

use App\Repository\MaisonsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
class PanierController extends AbstractController
{
    #[Route('/panier', name: 'app_panier')]
    public function panier(SessionInterface $session, MaisonsRepository $maisonsRepository): Response
    {
        $panier = $session->get('panier',[]);
        $newPanier = [];
        foreach ($panier as $id => $quantité) {
            $newPanier [] = [
                'maisons'=> $maisonsRepository->find($id),
                'quantité'=> $quantité
            ];
        }
        $total = 0;
        foreach ($newPanier as $item) {
            $totalprod = $item['maisons']->getPrix() * $item['quantité'];
            $total += $totalprod;
        }
        $sum = 0;
        $taille = count($newPanier);
        $i = 0;
        while ($i < $taille){
            $sum += $item['quantité'] ;
            $i++;
        }
        return $this->render('panier/index.html.twig', [
            'paniers' => $newPanier,
            'total' => $total,
            'somme' => $sum
        ]);
    }

    #[Route('/panier/achat/{id}', name: 'panier_achat')]
    public function achat($id, SessionInterface $session)
    {
        $panier = $session->get('panier', []);
        if (!empty($panier[$id])) {
            $panier[$id] = $panier[$id]+1;
        } else {
            $panier[$id] = 1;
        }
        $session->set('panier', $panier);
        return $this->redirectToRoute('app_panier');
    }

    #[Route('/panier/delete/{id}', name: 'panier_delete')]
    public function delete ($id, SessionInterface $session)
    {
        $panier = $session->get('panier', []);
        if(!empty($panier[$id])){
            unset($panier[$id]);
        }
        $session->set('panier', $panier);
        return $this->redirectToRoute('app_panier');
    }
    #[Route('/panier/dimunuer/{id}{quantité}', name: 'panier_dimunuer')]
    public function dimunuer($id,$quantité, SessionInterface $session)
    {
        $panier = $session->get('panier',[]);
        if($quantité>1){
            if (!empty($panier[$id])) {
                $panier[$id]= $panier[$id]-1;
                }
            }
            else{
                unset($panier[$id]);
        }
        
        $session->set('panier', $panier);
        return $this->redirectToRoute('app_panier');
    }

}
