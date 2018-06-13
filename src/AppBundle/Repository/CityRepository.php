<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\TransportIntercity;

class CityRepository extends EntityRepository
{
    /**
     * @return array
     */
    public function getFromByActiveTransportIntercity()
    {
        $query = $this->createQueryBuilder('p')
            ->select('p')
            ->innerJoin(TransportIntercity::class,'transport', 'WITH', 'transport.cityFrom = p.id')
            ->orderBy('p.name','ASC')
            ->distinct()
            ->getQuery();

        return $query->getArrayResult();
    }

    public function getInByActiveTransportIntercity()
    {
        $query = $this->createQueryBuilder('p')
            ->select('p')
            ->innerJoin(TransportIntercity::class,'transport', 'WITH', 'transport.cityIn = p.id')
            ->orderBy('p.name','ASC')
            ->distinct()
            ->getQuery();

        return $query->getArrayResult();
    }

}