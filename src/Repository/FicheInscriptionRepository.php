<?php

namespace App\Repository;

use App\Entity\FicheInscription;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FicheInscription|null find($id, $lockMode = null, $lockVersion = null)
 * @method FicheInscription|null findOneBy(array $criteria, array $orderBy = null)
 * @method FicheInscription[]    findAll()
 * @method FicheInscription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FicheInscriptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FicheInscription::class);
    }

    // /**
    //  * @return FicheInscription[] Returns an array of FicheInscription objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FicheInscription
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
