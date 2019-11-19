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

    public function testSimulateComputerRound()
    {
        $game = new Dice100();
        $game->simulateComputerRound();
        $this->assertNotEmpty($game->num);
    }

    public function testPrintHistogramWithNum()
    {
        $dice = new Dice();
        $recievedRes = $dice->printHistogram(2, 4);
        $expectedRes = "<br>" . "2: " . "<br>" . "3: " . "<br>" . "4: " . "<br>";
        $this->assertEquals($expectedRes, $recievedRes);
    }

    public function testPrintHistogram()
    {
        $dice = new Dice();
        $dice->rollDice(4);
        $recievedRes = $dice->printHistogram();
        $this->assertEquals("4, " . "<br>" . "4: *" . "<br>", $recievedRes);
    }

    public function testGetHistogramSerie()
    {
        $dice = new Dice();
        $recievedRes = $dice->getHistogramSerie();
        $this->assertEquals([], $recievedRes);
    }
}
