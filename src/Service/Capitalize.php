<?php

namespace App\Service;
use App\Service\Transform;


class Capitalize implements Transform
{

    public function transform(string $string): string
    {
        for ($i = 0; $i < strlen($string); $i++) {
            if ($i % 2 != 0) {
                $string[$i] = strtoupper($string[$i]);
            }
        }
        return $string;

    }
}