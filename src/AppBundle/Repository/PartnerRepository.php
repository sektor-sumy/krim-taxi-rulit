<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\TransportIntercity;

class PartnerRepository extends EntityRepository
{
    function getAllActive()
    {
        $qb = $this->createQueryBuilder('p')
            ->select('p')
            ->where('p.isActive = true')
            ->getQuery();

        return $qb->execute();
    }
}