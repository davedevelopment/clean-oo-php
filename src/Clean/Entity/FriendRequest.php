<?php

namespace Clean\Entity;

class FriendRequest
{
    protected $id;
    protected $from;
    protected $to;

    public function __construct(User $from, User $to)
    {
        $this->from = $from;
        $this->to = $to;
    }
}
