<?php

namespace App\Service;
namespace App\Service\transform;


class change implements transform
{

    public function transform(string $string): string
    {
       return str_replace(' ', '-', $string);
    }
}