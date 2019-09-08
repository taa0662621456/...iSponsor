<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Project\ProjectsEnGb;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ProjectsEnGb|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectsEnGb|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectsEnGb[]    findAll()
 * @method ProjectsEnGb[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectsEnGbRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProjectsEnGb::class);
    }

    // /**
    //  * @return ProjectsEnGb[] Returns an array of ProjectsEnGb objects
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
    public function findOneBySomeField($value): ?ProjectsEnGb
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
