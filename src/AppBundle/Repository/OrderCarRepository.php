<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class OrderCarRepository extends EntityRepository
{
    function getCountNew()
    {
        $qb = $this->createQueryBuilder('p')
            ->select('count(p)')
            ->where('p.viewedAt = 0')
            ->getQuery();

        return $qb->execute();
    }

    function getAllOrderByDesc()
    {
        $qb = $this->createQueryBuilder('p')
            ->select('p')
            ->orderBy('p.id', 'DESC')
            ->getQuery();

        return $qb->execute();
    }
}