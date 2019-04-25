<?php

require __DIR__ . "/autoload.php";
require __DIR__ . "/config.php";
require __DIR__ . "/src/Guess.php";

session_start();

if (!isset($_SESSION["game"])) {
    $_SESSION["game"] = new Guess();
}

$res = "";

if (isset($_SESSION["res"])) {
    $res = $_SESSION["res"];
}
$game = $_SESSION["game"];
$guess =  $_POST["guess"] ?? null;
$doInit =  $_POST["doInit"] ?? null;
$doGuess = $_POST["doGuess"] ?? null;
$doCheat = $_POST["doCheat"] ?? null;

if ($doInit) {
    session_destroy();
    $_SESSION["game"] = new Guess();
    header("Location: ./");
} elseif ($doGuess) {
    $_SESSION["res"] = $game->makeGuess($guess);
    header("Location: ./");
} elseif ($doCheat) {
    $_SESSION["res"] = $game->doCheat();
    header("Location: ./");
}

require __DIR__ . "/view/guess_number.php";
