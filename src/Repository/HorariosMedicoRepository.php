<?php

namespace App\Repository;

use App\Entity\HorariosMedico;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method HorariosMedico|null find($id, $lockMode = null, $lockVersion = null)
 * @method HorariosMedico|null findOneBy(array $criteria, array $orderBy = null)
 * @method HorariosMedico[]    findAll()
 * @method HorariosMedico[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HorariosMedicoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HorariosMedico::class);
    }

    // /**
    //  * @return HorariosMedico[] Returns an array of HorariosMedico objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HorariosMedico
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
