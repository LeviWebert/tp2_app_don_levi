<?php

namespace App\Repository;

use App\Entity\PromesseDeDon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PromesseDeDon>
 *
 * @method PromesseDeDon|null find($id, $lockMode = null, $lockVersion = null)
 * @method PromesseDeDon|null findOneBy(array $criteria, array $orderBy = null)
 * @method PromesseDeDon[]    findAll()
 * @method PromesseDeDon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DonateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PromesseDeDon::class);
    }

    public function save(PromesseDeDon $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PromesseDeDon $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return PromesseDeDon[] Returns an array of PromesseDeDon objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PromesseDeDon
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
