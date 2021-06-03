<?php

namespace App\Repository;

use App\Entity\GameHouse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GameHouse|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameHouse|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameHouse[]    findAll()
 * @method GameHouse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameHouseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameHouse::class);
    }

    public function findOneById($id): ?GameHouse
    {
        try {
            return $this->createQueryBuilder('g')
                ->andWhere('g.id = :id')
                ->setParameter('id', $id)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
        }
    }
}
