<?php

namespace AppBundle\Entity;


use Doctrine\ORM\EntityRepository;

class ParticipantRepository extends EntityRepository
{
    public function getTotalCount()
    {
        return $this->createQueryBuilder('p')
            ->select('count(p.id)')
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }
}