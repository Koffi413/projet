<?php

namespace App\Repository;

use App\Entity\Maisons;
use App\Entity\Search;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Maisons>
 *
 * @method Maisons|null find($id, $lockMode = null, $lockVersion = null)
 * @method Maisons|null findOneBy(array $criteria, array $orderBy = null)
 * @method Maisons[]    findAll()
 * @method Maisons[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaisonsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Maisons::class);
    }

    /**
     * @return Maisons[] Returns an array of Maisons objects
     */
    public function findByCategorie($value): array
    {
        return $this->createQueryBuilder('m')
            ->Where('m.idMaisons = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
   }
   public function findByMax($value): array
    {
        return $this->createQueryBuilder('m')
            ->Where('m.prix <= :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
   }
   public function findByMin($value): array
    {
        return $this->createQueryBuilder('m')
            ->Where('m.prix >= :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
   }
   
   public function findBySearch(Search $search)
   {
       $queryBuilder = $this->createQueryBuilder('m');

       // Si une catégorie est sélectionnée, filtrez par catégorie
       if ($search->getCategorie()) {
           $queryBuilder
               ->andWhere('m.idMaisons = :categorie')
               ->setParameter('categorie', $search->getCategorie());
       }

       // Si des valeurs min et max sont définies, filtrez par prix
       if ($search->getMin()) {
           $queryBuilder
               ->andWhere('m.prix >= :min')
               ->setParameter('min', $search->getMin());
       }

       if ($search->getMax()) {
           $queryBuilder
               ->andWhere('m.prix <= :max')
               ->setParameter('max', $search->getMax());
       }

       // Exécutez la requête et retournez les résultats
       return $queryBuilder->getQuery()->getResult();
   }


//    public function findOneBySomeField($value): ?Maisons
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}