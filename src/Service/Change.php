<?php

namespace App\Service;
use App\Service\Transform;


class Change implements Transform
{

    public function transform(string $string): string
    {
       return str_replace(' ', '-', $string);
    }
}