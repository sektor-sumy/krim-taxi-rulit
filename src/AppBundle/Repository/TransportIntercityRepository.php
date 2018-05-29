<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class TransportIntercityRepository extends EntityRepository
{
    /**
     * @return array
     */
    public function getAllActive()
    {
        $query = $this->createQueryBuilder('c')
            ->select('')
            ->getQuery();

        return $query->getArrayResult();
    }

    /**
     * @return array
     */
    public  function getClasses()
    {
        $query = $this->createQueryBuilder('c')
            ->select('c.class')
            ->groupBy('c.class')
            ->getQuery();

        return $query->getArrayResult();
    }

}