<?php

namespace App\Service;


interface Transform
{
    public function transform(string $string):string;

}