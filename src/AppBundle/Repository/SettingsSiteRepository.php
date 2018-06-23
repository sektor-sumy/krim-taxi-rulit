<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\TransportIntercity;

class SettingsSiteRepository extends EntityRepository
{

    function allNotActivated()
    {
        $qb = $this->createQueryBuilder('p')
            ->update()
            ->set('p.isActive','false')
            ->getQuery();

        return $qb->execute();
    }

    function getActive()
    {
        $qb = $this->createQueryBuilder('p')
            ->select('p')
            ->where('p.isActive = true')
            ->getQuery();

        return $qb->execute();
    }
}
