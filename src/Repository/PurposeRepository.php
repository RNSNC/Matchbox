<?php

namespace App\Repository;

use App\Entity\Purpose;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Purpose|null find($id, $lockMode = null, $lockVersion = null)
 * @method Purpose|null findOneBy(array $criteria, ?array $orderBy = null)
 * @method Purpose[]    findAll()
 * @method Purpose[]    findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null)
 */
class PurposeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Purpose::class);
    }

    public function add(Purpose $entity, bool $flush = false):void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}