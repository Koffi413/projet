<?php

namespace App\Repository;

use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Client>
 *
 * @method Client|null find($id, $lockMode = null, $lockVersion = null)
 * @method Client|null findOneBy(array $criteria, array $orderBy = null)
 * @method Client[]    findAll()
 * @method Client[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

//    /**
//     * @return Client[] Returns an array of Client objects
//     */
  public function findByClient(Client $client): array
    {
        $queryBuilder = $this->createQueryBuilder('m');

       // Si une catégorie est sélectionnée, filtrez par catégorie
       if ($client->getEmail()) {
           $queryBuilder
               ->andWhere('m.email :email')
               ->setParameter('email', $client->getEmail());
       }

       // Si des valeurs min et max sont définies, filtrez par prix
       if ($client->getPassword()) {
           $queryBuilder
               ->andWhere('m.password  :Password')
               ->setParameter('Password', $client->getPassword());
       }

       // Exécutez la requête et retournez les résultats
       return $queryBuilder->getQuery()->getResult();
    }

//    public function findOneBySomeField($value): ?Client
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
