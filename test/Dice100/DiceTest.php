<?php

namespace Frida\Dice100;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class DiceTest extends TestCase
{
    public function testCreateObject()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\Frida\Dice100\Dice", $dice);

        $res = $dice->number;
        $exp = 0;
        $this->assertEquals($exp, $res);
    }

    public function testRollDice()
    {
        $dice = new Dice();
        $res = $dice->rollDice();
        
        $this->assertGreaterThan(0, $res);
        $this->assertLessThan(7, $res);
    }

    public function testRandomNumber()
    {
        $dice = new Dice();
        $res = $dice->random();
        
        $this->assertGreaterThan(0, $res);
        $this->assertLessThan(7, $res);
    }
}
