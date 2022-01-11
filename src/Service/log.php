<?php

namespace App\Service;

class log
{
public function logger(string $message){
    $message .= "\n";
    file_put_contents('log.info', $message, FILE_APPEND);
}
}