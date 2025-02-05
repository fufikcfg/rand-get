<?php

class RandomGenerator
{
    public function generate(): int
    {
        return rand(1, 100);
    }
}