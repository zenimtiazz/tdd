<?php

namespace App\Service;
use App\Service\Transform;


class Log
{
public function logger(string $message){
    $message .= "\n";
    file_put_contents('log.info', $message, FILE_APPEND);
}
}