<?php

namespace App\Repository;

use App\Entity\Musees;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Musees|null find($id, $lockMode = null, $lockVersion = null)
 * @method Musees|null findOneBy(array $criteria, array $orderBy = null)
 * @method Musees[]    findAll()
 * @method Musees[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MuseesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Musees::class);
    }

    // /**
    //  * @return Musees[] Returns an array of Musees objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Musees
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
