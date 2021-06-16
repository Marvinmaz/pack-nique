<?php

namespace App\Repository;

use App\Entity\Sana;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sana|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sana|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sana[]    findAll()
 * @method Sana[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SanaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sana::class);
    }

    // /**
    //  * @return Sana[] Returns an array of Sana objects
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
    public function findOneBySomeField($value): ?Sana
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
