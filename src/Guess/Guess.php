<?php

namespace Frida\Guess;

require __DIR__ . "/GuessException.php";

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class Guess
{
    /**
     * @var int $number   The current secret number.
     * @var int $tries    Number of tries a guess has been made.
     */
    public $number;
    public $tries;


    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param int $number The current secret number, default -1 to initiate
     *                    the number from start.
     * @param int $tries  Number of tries a guess has been made,
     *                    default 6.
     */

    public function __construct(int $number = -1, int $tries = 6)
    {
        $this->number = $number;
        $this->tries = $tries;

        if ($this->number == -1) {
            $this->random();
        }
    }



    /**
     * Randomize the secret number between 1 and 100 to initiate a new game.
     *
     * @return void
     */

    public function random()
    {
        $this->number = rand(1, 100);
    }



    /**
     * Get number of tries left.
     *
     * @return int as number of tries made.
     */

    public function tries()
    {
        return $this->tries;
    }



    /**
     * Get the secret number.
     *
     * @return int as the secret number.
     */

    public function number()
    {
        return $this->number;
    }



    /**
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low or to high or if no guesses remains.
     * 
     * @throws GuessException when guessed number is out of bounds.
     *
     * @return string to show the status of the guess made.
     */

    public function makeGuess($guess)
    {
        if ($guess < 0 || $guess > 100) {
            $res = $this->incorrectGuess($guess);
        } elseif ($guess == $this->number) {
            $res = "CORRECT! Restart to try again.";
            $this->tries = 0;
        } elseif ($this->tries == 0) {
            $res = "You have no tries left! Restart to try again.";
        } elseif ($guess > $this->number) {
            $this->tries -= 1;
            if ($this->tries != 0) {
                $res = "Your {$guess} is TOO HIGH";
            }
        } elseif ($guess < $this->number) {
            $this->tries -= 1;
            if ($this->tries != 0) {
                $res = "Your {$guess} is TOO LOW";
            }
        }
        return $res;
    }

    public function incorrectGuess($guess)
    {
        try {
            throw new GuessException();
        } catch (GuessException $exception) {
            $res = "Du måste gissa på ett nummer mellan 0 och 100. Du gissade på {$guess}.";
        }
        return $res;
    }

    public function doCheat()
    {
        $res = "CHEAT: Current number is {$this->number}";
        return $res;
    }
}
