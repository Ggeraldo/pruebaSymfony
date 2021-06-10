<?php

namespace App\Repository;

use App\Entity\PostImg;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PostImgCsv|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostImgCsv|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostImgCsv[]    findAll()
 * @method PostImgCsv[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostCsvRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostImg::class);
    }

    // /**
    //  * @return PostImg[] Returns an array of PostImg objects
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
    public function findOneBySomeField($value): ?PostImg
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
