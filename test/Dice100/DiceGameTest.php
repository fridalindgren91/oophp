<?php

namespace Frida\Dice100;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice100.
 */
class DiceGameTest extends TestCase
{
    public function testCreateGameObject()
    {
        $game = new Dice100();
        $this->assertInstanceOf("\Frida\Dice100\Dice100", $game);

        $res = $game->playing;
        $exp = false;
        $this->assertEquals($exp, $res);
    }

    public function testStartRound()
    {
        $game = new Dice100();
        $game->startRound();
        
        $res = $game->playing;
        $exp = true;
        $this->assertEquals($exp, $res);
    }

    public function testStopRound()
    {
        $game = new Dice100();
        $game->stopRound();
        $res = $game->playing;
        $exp = false;
        $this->assertEquals($exp, $res);
    }

    public function testRoll()
    {
        $game = new Dice100();
        $game->roll();
        $res = $game->num;
        $this->assertGreaterThan(0, $res);
        $this->assertLessThan(7, $res);
    }
}
