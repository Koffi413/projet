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
    public function findBytype($value): array
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
   public function findSearch(Search $search): array
    {
        $query = $this
        ->createQueryBuilder('p')
        ->select('c', 'p')
        ->join('c.idMaisons.nom', 'c');

        if (!empty($search->q)) {
            $query  = $query
                ->andWhere('p.name LIKE')
                ->setParameter('q', "%{$search->q}%");
        }

        if (!empty($search->min)) {
            $query  = $query
                ->andWhere('p.prix >= :min')
                ->setParameter('min', $search->min);
        }

        if (!empty($search->max)) {
            $query  = $query
                ->andWhere('p.prix <= :max')
                ->setParameter('max', $search->max);
        }

        if (!empty($search->promo)) {
            $query  = $query
                ->andWhere('p.promo = 1');
        }

        if (!empty($search->Maisons)) {

            $query = $query
                ->andWhere('c.idMaisons IN (:Categorie)')
                ->setParameter('Maisons', $search->Maisons );
        }

        return $query->getQuery()->getResult();
        ;
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
