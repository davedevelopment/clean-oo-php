<?php

namespace Clean\UseCase;

class FriendshipRequestRequest 
{
    public $fromUserId;
    public $toUserId;

    public function __construct($fromUserId, $toUserId)
    {
        $this->fromUserId = $fromUserId;
        $this->toUserId = $toUserId;
    }
}
