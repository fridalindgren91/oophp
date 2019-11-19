<?php

namespace Frida\Dice100;

/**
 * A trait implementing histogram for integers.
 */
trait HistogramTrait
{
    /**
     * @var array $serie  The numbers stored in sequence.
     */
    private $serie = [];



    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getHistogramSerie()
    {
        return $this->serie;
    }



    /**
     * Print out the histogram, default is to print out only the numbers
     * in the serie, but when $min and $max is set then print also empty
     * values in the serie, within the range $min, $max.
     *
     * @param int $min The lowest possible integer number.
     * @param int $max The highest possible integer number.
     *
     * @return string representing the histogram.
     */
    public function printHistogram(int $min = null, int $max = null)
    {
        $serieStr = "";
        $appearenceNum = array();
        $one = "1: ";
        $two = "2: ";
        $three = "3: ";
        $four = "4: ";
        $five = "5: ";
        $six = "6: ";

        $serieStr = $this->switchCase($serieStr, $appearenceNum, $one, $two, $three, $four, $five, $six);

        if ($min == null && $max == null) {
            $numSerie = "";
            $diceArray = array();
            $diceArray[] = $one;
            $diceArray[] = $two;
            $diceArray[] = $three;
            $diceArray[] = $four;
            $diceArray[] = $five;
            $diceArray[] = $six;
            for ($i = 0; $i < 6; $i++) {
                if (strlen($diceArray[$i]) > 3) {
                    $numSerie .= $diceArray[$i] . "<br>";
                }
            }
            return $serieStr . "<br>" . $numSerie;
        } else {
            $minMaxSerie = "";
            $diceArray = array();
            $diceArray[] = $one;
            $diceArray[] = $two;
            $diceArray[] = $three;
            $diceArray[] = $four;
            $diceArray[] = $five;
            $diceArray[] = $six;
            for ($i = $min-1; $i < $max; $i++) {
                $minMaxSerie .= $diceArray[$i] . "<br>";
            }
            return $serieStr . "<br>" . $minMaxSerie;
        }
    }

    public function switchCase(&$serieStr, &$appearenceNum, &$one, &$two, &$three, &$four, &$five, &$six)
    {
        for ($i = 0; $i < count($this->serie); $i++) {
            switch ($this->serie[$i]) {
                case 1:
                    $one .= "*";
                    $appearenceNum[] = 1;
                    break;
                case 2:
                    $two .= "*";
                    $appearenceNum[] = 2;
                    break;
                case 3:
                    $three .= "*";
                    $appearenceNum[] = 3;
                    break;
                case 4:
                    $four .= "*";
                    $appearenceNum[] = 4;
                    break;
                case 5:
                    $five .= "*";
                    $appearenceNum[] = 5;
                    break;
                case 6:
                    $six .= "*";
                    $appearenceNum[] = 6;
                    break;
            }
            $serieStr .= $this->serie[$i] . ", ";
        }
        return $serieStr;
    }
}
