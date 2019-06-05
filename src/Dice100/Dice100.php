<?php

namespace Frida\Dice100;

require __DIR__ . "/DiceException.php";

class Dice100
{
    public $sum;

    public $num;

    public $userTotalSum;
    public $computerTotalSum;

    public $resultText;

    public $currentPlayer;

    public $playing;

    public $dice;

    public function __construct()
    {
        $this->playing = false;
        $this->sum = 0;
        $this->userTotalSum = 0;
        $this->computerTotalSum = 0;
        $this->resultText = "";
        $this->currentPlayer = 1;
        $this->dice = new \Frida\Dice100\Dice();
    }

    public function stopRound()
    {
        if ($this->currentPlayer == 0) {
            $this->computerTotalSum += $this->sum;
            $this->currentPlayer = 1;
        } else {
            $this->userTotalSum += $this->sum;
            $this->currentPlayer = 0;
        }
        $this->playing = false;
    }

    public function simulateComputerRound()
    {
        do {
            $randomNumber = rand(1, 3);
            $diceNumber = $this->roll();
            if ($diceNumber == 1) {
                return;
            }
        } while ($randomNumber != 3);
        $this->stopRound();
    }

    public function startRound()
    {
        $this->dice->number = 0;
        $this->sum = 0;
        $this->playing = true;

        if ($this->currentPlayer == 0) {
            $this->simulateComputerRound();
        }
    }

    public function roll()
    {
        $this->num = $this->dice->rollDice();

        if ($this->num == 1) {
             $this->sum = 0;
             $this->stopRound();
        } else {
             $this->sum += $this->num;
        }
        return $this->num;
    }
}
