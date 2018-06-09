<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CallbackRepository extends EntityRepository
{
    function findAllOrderByCreatedAt()
    {
        $qb = $this->createQueryBuilder('p')
            ->orderBy('p.createdAt', 'DESC')
            ->getQuery();

        return $qb->execute();
    }

    function getCountNew()
    {
        $qb = $this->createQueryBuilder('p')
            ->select('count(p)')
            ->where('p.viewedAt = 0')
            ->getQuery();

        return $qb->execute();
    }
}