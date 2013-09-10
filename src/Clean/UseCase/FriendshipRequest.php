<?php

namespace Clean\UseCase;

use Clean\Repository\UserRepository;

class FriendshipRequest 
{
    protected $repo;

    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }
    
    public function execute(FriendshipRequestRequest $request, FriendshipRequestResponder $responder)
    {
        $from = $this->repo->findOrThrow($request->fromUserId);
        $to   = $this->repo->findOrThrow($request->toUserId);

        try {
            $to->considerFriendship($from);
            $responder->proposalReceived($from, $to);
        } catch (\InvalidArgumentException $e) {
            $responder->proposalFailed($from, $to, $e->getCode(), $e->getMessage());
        }
    }
}
