<?php

namespace Clean\Repository;

class EntityNotFoundException extends Exception
{
    public $entityName;
    public $entityId;

    public function __construct($entityName, $entityId)
    {
        $this->entityName = $entityName;
        $this->entityId = $entityId;
    }

    public function getMessage()
    {
        return "Could not find ".$this->entityName;
    }
}
    
