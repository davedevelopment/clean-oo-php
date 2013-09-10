<?php

namespace CleanDoctrine\Repository;

use Clean\Repository\UserRepository as IUserRepository;
use Clean\Repository\EntityNotFoundException;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository implements IUserRepository
{
    public function findOrThrow($id)
    {
        $user = parent::find($id);
        if (null === $user) {
            throw new EntityNotFoundException("Clean\Entity\User", $id);
        }

        return $user;
    }
}
