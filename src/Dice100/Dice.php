<?php

namespace Frida\Dice100;

class Dice
{
    use HistogramTrait;

    public $number;

    public function __construct()
    {
        $this->number = 0;
    }

    public function rollDice(int $num = null)
    {
        if ($num == null) {
            $this->number = $this->random();
        } else {
            $this->number = $num;
        }
        $this->serie[] = $this->number; // Add new number to histogram
        return $this->number;
    }

    public function random()
    {
        $this->number = rand(1, 6);
        return $this->number;
    }
}
