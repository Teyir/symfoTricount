<?php

namespace App\Repository;

use App\Entity\Soirees;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Soirees|null find($id, $lockMode = null, $lockVersion = null)
 * @method Soirees|null findOneBy(array $criteria, array $orderBy = null)
 * @method Soirees[]    findAll()
 * @method Soirees[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SoireesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Soirees::class);
    }

    // /**
    //  * @return Soirees[] Returns an array of Soirees objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Soirees
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
