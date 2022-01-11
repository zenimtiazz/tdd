<?php

namespace App\Service;
use App\Service\Capitalize;
use App\Service\Change;
use App\Service\Log;
use App\Service\Transform;



class Master
{
private Transform $transform;
private Log $log;
private string $message;

public function __construct(Transform $transform,Log $log)
{
    $this->transform = $transform;
    $this->log = $log;
}
public function transform(String $message): string
{
  return $this->transform->transform($message);
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