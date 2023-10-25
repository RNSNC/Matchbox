<?php

namespace App\Repository;

use App\Entity\Matchbox;
use App\Model\Matchbox\MatchboxDto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Matchbox|null find($id, $lockMode = null, $lockVersion = null)
 * @method Matchbox|null findOneBy(array $criteria, ?array $orderBy = null)
 * @method Matchbox[]    findAll()
 * @method Matchbox[]    findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null)
 */
class MatchboxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Matchbox::class);
    }

    public function add(Matchbox $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findDTO(int $id = null, string $manufacturer = null)
    {
        $query = $this->createQueryBuilder('m')
            ->select(sprintf(
                'NEW %s(m.id, mf.name, p.name, m.countMatch, m.length, m.description)',
                MatchboxDto::class,
            ))
            ->leftJoin('m.manufacturer', 'mf')
            ->leftJoin('m.purpose', 'p')
        ;

        if ($id){
            $query
                ->where('m.id = :id')
                ->setParameter('id', $id)
            ;
        }else{
            $query->orderBy('mf.name', 'DESC');
        }

        if ($manufacturer){
            $query
                ->where('mf.name = :mfName')
                ->setParameter('mfName', $manufacturer)
            ;
        }

        return $query
            ->getQuery()
            ->getResult()
        ;
    }
}