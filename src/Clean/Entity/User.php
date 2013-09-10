<?php

namespace Clean\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class User 
{
    protected $id;
    protected $name; 
    protected $friends;
    protected $friendRequests;

    public function __construct($name)
    {
        $this->name = $name;
        $this->friends = new ArrayCollection();
        $this->friendRequests = new ArrayCollection();
    }

    public function considerFriendship(User $user)
    {
        $request = new FriendRequest($user, $this);
        $this->friendRequests->add($request);
    }
}
