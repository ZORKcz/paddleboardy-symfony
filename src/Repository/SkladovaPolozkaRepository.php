<?php

namespace App\Repository;

use App\Entity\SkladovaPolozka;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SkladovaPolozka>
 */
class SkladovaPolozkaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SkladovaPolozka::class);
    }

    /**
     * Vezme vsechny skladove polozky pro danou stanici, ktere jsou dostupne
     */
    public function najdiDostupneProStanici(int $staniceId): array
    {
        return $this->createQueryBuilder('s')
            ->join('s.produkt', 'p')
            ->addSelect('p')
            ->andWhere('s.stanice = :staniceId')
            ->andWhere('s.mnozstvi_skladem > 0')
            ->setParameter('staniceId', $staniceId)
            ->getQuery()
            ->getResult();
    }



    //    /**
    //     * @return SkladovaPolozka[] Returns an array of SkladovaPolozka objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?SkladovaPolozka
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
