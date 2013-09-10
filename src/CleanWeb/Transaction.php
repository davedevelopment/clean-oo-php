<?php

namespace CleanWeb;

class Transaction 
{
    protected $em;

    public function __construct(Doctrine\ORM\EntityManager $em, callable $callable)
    {
        $this->em = $em;
        $this->callable = $callable;
    }

    public function execute()
    {
        $args = func_get_args();
        return $this->em->transactional(function ($em) use ($args) {
            return call_user_func_array($this->callable, $args);
        });
    }
}
