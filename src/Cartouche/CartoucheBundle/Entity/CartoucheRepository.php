<?php

namespace Cartouche\CartoucheBundle\Entity;

use Doctrine\ORM\EntityRepository;

class CartoucheRepository extends EntityRepository
{
    public function getCartoucheToNotify()
    {
        return $this->createQueryBuilder('c')
            ->where('c.notificationEnabled = 1')
            ->andWhere('c.nextChangeDate <= CURRENT_DATE()')
            ->andWhere('c.notificationSent = 0')
            ->getQuery()
            ->execute();
    }
}
