<?php

namespace CleanWeb;

use Clean\UseCase\FriendshipRequestResponder;
use Clean\Entity\User;
use CleanWeb\View;

class FriendshipRequestPresenter implements FriendshipRequestResponder
{
    protected $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    function proposalReceived(User $from, User $to)
    {
        $this->view->notice("Friendship Request under consideration");
        $this->view->redirectTo("/");    
    }

    function proposalFailed(User $from, User $to, $failureCode, $failureMessage)
    {
        $this->view->error("Friendship Request could not be sent, please contact support");
        $this->view->redirectTo("/");    
    }
}
