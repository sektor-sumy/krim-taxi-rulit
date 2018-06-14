<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\TransportIntercity;

class TransportIntercityRepository extends EntityRepository
{
    /**
     * @return array
     */
    public function getAllActive()
    {
        $query = $this->createQueryBuilder('')
            ->select('')
            ->getQuery();

        return $query->getArrayResult();
    }

    /**
     * @return array
     */
    public  function getClasses()
    {
        $query = $this->createQueryBuilder('p')
            ->select('p.class')
            ->groupBy('p.class')->getQuery();

        return $query->getArrayResult();
    }

}