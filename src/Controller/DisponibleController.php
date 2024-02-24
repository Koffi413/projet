<?php

namespace App\Controller;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Maisons;

class DisponibleController extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Maisons::class);
    }

    /**
     * @return Maisons[]
     */
    public function findBymaisonsdisponible(bool $dispo): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Maisons p
            WHERE p.disponibilite == 0
            ORDER BY p.name ASC'
        )->setParameter('disponibilite', $dispo);

        // returns an array of Product objects
        return $query->getResult();
    }
}
