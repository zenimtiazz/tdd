<?php

namespace App\Service;
use App\Service\Capitalize;
use App\Service\Change;
use App\Service\Log;



class Master
{
private Capitalize $capitalize;
private Change $change;
private Log $log;
private string $message;

public function __construct(Capitalize $capitalize,Change $change,Log $log)
{
    $this->capitalize = $capitalize;
    $this->change = $change;
    $this->log = $log;
}
public function transform(String $message, String $className): string
{
    if($className === 'capitalize'){
        $this->message = $this->capitalize->transform($this->message);
    }
    elseif ($className === 'change'){
        $this->message = $this->change->transform($this->change);
    }
   return $this->message;
}

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function log()
    {
        return $this->log->logger($this->message);
    }
}