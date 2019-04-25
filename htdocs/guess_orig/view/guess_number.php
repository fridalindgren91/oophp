<h1>Guess the number</h1>
<p>Guess a number between 1 and 100, you have <?= $game->tries ?> left.</p>

<form method="post">
    <input type="text" name="guess">
    <input type="submit" name="doGuess" value="Guess">
    <input type="submit" name="doInit" value="Restart">
    <input type="submit" name="doCheat" value="Cheat">
</form>

<p><?= $res ?></p>
