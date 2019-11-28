<?php

namespace App\Repository;

use App\Entity\Planos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Planos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Planos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Planos[]    findAll()
 * @method Planos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Planos::class);
    }

    // /**
    //  * @return Planos[] Returns an array of Planos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Planos
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}