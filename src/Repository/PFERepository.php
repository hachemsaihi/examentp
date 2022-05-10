<?php

namespace App\Repository;

use App\Entity\PFE;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PFE>
 *
 * @method PFE|null find($id, $lockMode = null, $lockVersion = null)
 * @method PFE|null findOneBy(array $criteria, array $orderBy = null)
 * @method PFE[]    findAll()
 * @method PFE[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PFERepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PFE::class);
    }

    public function add(PFE $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PFE $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return PFE[] Returns an array of PFE objects
//     */
    public function findByExampleField(): array
    {   $conn = $this->getEntityManager()->getConnection();
        $sql='
        SELECT COUNT(P.TITLE) as nbr,P.entreprise_id as id
        FROM pfe P 
        GROUP BY P.entreprise_id
        ';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        return $resultSet->fetchAllAssociative();
//        return $this->createQueryBuilder('p')
//            ->select("COUNT(p.title) as nbr,p.entreprise")
//            ->groupBy('p.entreprise')
//            ->getQuery()
//            ->getArrayResult()
//        ;
    }

//    public function findOneBySomeField($value): ?PFE
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
