<?php

namespace AppBundle\RepositoryORM;

use Doctrine\ORM\EntityRepository;

/**
 * Company
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class Company extends EntityRepository
{

//    public function getSelectedCompany($trainee)
//    {
//        $qb = $this->createQueryBuilder('CompayObject');
//        $qb->where('CompayObject.luckListCompany  = :a')
//            ->setParameter('a',$trainee);
//        $qb->orderBy('TraineeObject.luckNo','ASC');
//        $result = $qb->getQuery()->getResult();
//        return $result;
//    }
}
