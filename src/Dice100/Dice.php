<?php

namespace Frida\Dice100;

class Dice
{
    public $number;

    public function __construct()
    {
        $this->number = 0;
    }

    public function rollDice()
    {
        $this->number = $this->random();
        return $this->number;
    }

    public function random()
    {
        $this->number = rand(1, 6);
        return $this->number;
    }
}
