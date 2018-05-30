<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\TransportIntercity;

class TransportClassRepository extends EntityRepository
{
    /**
     * @return array
     */
    public function getByActiveTransportIntercity()
    {
        $query = $this->createQueryBuilder('p')
            ->select('p')
            ->leftJoin(TransportIntercity::class,'transport', 'WITH', 'transport.class = p.id')
            ->distinct()
            ->getQuery();
//        dump($query); die;

        return $query->getArrayResult();
    }

}