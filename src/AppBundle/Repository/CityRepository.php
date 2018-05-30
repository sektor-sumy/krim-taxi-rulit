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
            ->leftJoin(TransportIntercity::class,'transport', 'WITH', 'transport.cityFrom = p.id')
            ->distinct()
            ->getQuery();
//        dump($query); die;

        return $query->getArrayResult();
    }

    public function getInByActiveTransportIntercity()
    {
        $query = $this->createQueryBuilder('p')
            ->select('p')
            ->leftJoin(TransportIntercity::class,'transport', 'WITH', 'transport.cityIn = p.id')
            ->distinct()
            ->getQuery();
//        dump($query); die;

        return $query->getArrayResult();
    }

}