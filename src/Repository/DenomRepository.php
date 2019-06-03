<?php

namespace App\Repository;

use App\Entity\Denom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Denom|null find($id, $lockMode = null, $lockVersion = null)
 * @method Denom|null findOneBy(array $criteria, array $orderBy = null)
 * @method Denom[]    findAll()
 * @method Denom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DenomRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Denom::class);
    }

    // /**
    //  * @return Denom[] Returns an array of Denom objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Denom
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
