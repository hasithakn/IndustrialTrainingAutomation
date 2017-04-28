<?php

namespace AppBundle\RepositoryORM;

use Doctrine\ORM\EntityRepository;

/**
 * Trainee
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class Trainee extends EntityRepository
{
    public function getGPATraineeList($company){
        $qb = $this->createQueryBuilder('TraineeObject');
        $qb->where('TraineeObject.gpaCompany  = :a')
            ->setParameter('a',$company);
        $qb->orderBy('TraineeObject.gpa','DESC');
        $result = $qb->getQuery()->getResult();
        return $result;
    }
    public function getLuckListTraineeList($company){
        $qb = $this->createQueryBuilder('TraineeObject');
        $qb->where('TraineeObject.luckListCompany  = :a')
            ->setParameter('a',$company);
        $qb->orderBy('TraineeObject.luckNo','ASC');
        $result = $qb->getQuery()->getResult();
        return $result;
    }

//    public function selectedCompany($id){
//        $qb = $this->createQueryBuilder('TraineeObject');
//        $qb->where('TraineeObject.selectedCompany  = :a')
//            ->setParameter('a',$id);
//        $result = $qb->getQuery()->getResult();
//        return $result;
//    }


}
