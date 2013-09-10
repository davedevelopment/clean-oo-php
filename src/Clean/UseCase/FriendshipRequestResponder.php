<?php

namespace Clean\UseCase;

use Clean\Entity\User;

interface FriendshipRequestResponder 
{
    function proposalReceived(User $from, User $to);
    function proposalFailed(User $from, User $to, $failureCode, $failureMessage);
}
