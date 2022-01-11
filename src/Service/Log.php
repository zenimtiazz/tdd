<?php

namespace App\Service;



class Log
{
public function logger(string $message){
    $message .= "\n";
    file_put_contents('log.info', $message, FILE_APPEND);
}
}