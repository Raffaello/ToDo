<?php

namespace ToDo\Bundle\ToDoBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
//use Todo\Bundle\ToDoBundle\Entity\User;


class UserRepository extends EntityRepository
{
    public function qbfindById($id)
    {
        return $this->createQueryBuilder('q')
                ->where('q.id = :id')
                ->setParameter('id', $id);
    }
}