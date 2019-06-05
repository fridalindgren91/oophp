<?php

namespace Anax\View;

?><h1>Play the game</h1>
<h1>Dicegame 100</h1>
<p>Du ska slå en tärning och sammanlagt få en summa så nära 100 som möjligt. 
    Slår du en etta avbryts sin runda och du hamnar på en summa av 0.</p>

<?php if ($playing == false && $currentPlayer == 1 && $computerTotalSum < 100) { ?>
    <form method="post" action="startRound">
        <input type="submit" value="Starta runda" style="width: 180px">
    </form>
<?php } ?>

<?php if ($playing == false && $currentPlayer == 0 && $userTotalSum < 100) { ?>
    <form method="post" action="startRound">
        <input type="submit" value="Starta datorns runda" style="width: 180px">
    </form>
<?php } ?>

<?php if ($currentPlayer == 1 && $playing == true) { ?>
    <form method="post" action="rollDice">
        <input type="submit" value="Kasta tärning" style="width: 180px">
    </form>
<?php } ?>

<?php if ($computerTotalSum > 99) { ?>
    <p><i>Datorn vann över dig! Försök gärna igen.</i></p>
<?php } ?>

<?php if ($userTotalSum > 99) { ?>
    <p><i>Grattis! Du vann!</i></p>
<?php } ?>

<?php if ($number == 1 && $currentPlayer == 0) { ?>
    <p><i>Tyvärr! Du slog en etta.</i></p>
<?php } ?>

<?php if ($number == 1 && $currentPlayer == 1) { ?>
    <p><i>Datorn slog en etta.</i></p>
<?php } ?>

<?php if ($number != 0 && $currentPlayer == 1 && $playing == true) { ?>
<br><form method="post" action="stopRound">
        <input type="submit" value="Stanna" style="width: 180px">
    </form>
<?php } ?>

<?php if ($number != 0 && $currentPlayer == 1 && $playing == false) { ?>
    <p>Datorn fick summan: <?= $sum ?> denna runda.<br>
    Det är din tur.</p>
<?php } ?>

<?php if ($number != 0 && $currentPlayer == 1 && $playing == true) { ?>
    <p>Tärningen visar: <?= $number ?><br>
    Summa denna runda: <?= $sum ?></p>
<?php } ?>

    <p>Din totala summa: <?= $userTotalSum ?><br>
    Datorns totala summa: <?= $computerTotalSum ?></p>

<form method="post" action="restart">
    <input type="submit" value="Starta om" style="width: 180px">
</form>