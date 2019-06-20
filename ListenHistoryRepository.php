<?php

namespace App\Repository;

use App\Entity\ListenHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ListenHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListenHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListenHistory[]    findAll()
 * @method ListenHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListenHistoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ListenHistory::class);
    }

    // /**
    //  * @return ListenHistory[] Returns an array of ListenHistory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ListenHistory
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
