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
}