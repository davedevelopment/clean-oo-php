<?php

namespace Clean\Repository;

interface UserRepository 
{
    /**
     * @return User
     * @throws EntityNotFoundException
     */
    function findOrThrow($id);
}
