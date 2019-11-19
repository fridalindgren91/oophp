<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?><h1>Play the game</h1>
<h1>Guess the number</h1>
<p>Guess a number between 1 and 100, you have <?= $tries ?> left.</p>

<form method="post" action="guess">
    <input type="text" name="guess">
    <br><br>
    <input type="submit" value="Guess" style="width: 80px">
</form><br>

<form method="post" action="restart">
    <input type="submit" value="Restart" style="width: 80px">
</form><br>

<form method="post" action="cheat">
    <input type="submit" value="Cheat" style="width: 80px">
</form>

<p><?= $res ?></p>
