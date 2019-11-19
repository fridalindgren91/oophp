<?php
/**
 * Play game
 */
// $app->router->get("dice100/play", function () use ($app) {

//     if (!isset($_SESSION["rollDiceGame"])) {
//         $_SESSION["rollDiceGame"] = new \Frida\Dice100\Dice100();
//     }

//     $title = "Play the game";

//     $data = [
//         "number" => $_SESSION["rollDiceGame"]->dice->number,
//         "sum" => $_SESSION["rollDiceGame"]->sum,
//         "userTotalSum" => $_SESSION["rollDiceGame"]->userTotalSum,
//         "computerTotalSum" => $_SESSION["rollDiceGame"]->computerTotalSum,
//         "currentPlayer" => $_SESSION["rollDiceGame"]->currentPlayer,
//         "playing" => $_SESSION["rollDiceGame"]->playing
//     ];

//     $app->page->add("dice100/play", $data);

//     return $app->page->render([
//         "title" => $title
//     ]);
// });

// $app->router->post("dice100/restart", function () use ($app) {

//     session_destroy();

//     return $app->response->redirect("dice100/play");
// });

// $app->router->post("dice100/rollDice", function () use ($app) {

//     $_SESSION["diceRes"] = $_SESSION["rollDiceGame"]->roll();

//     return $app->response->redirect("dice100/play");
// });

// $app->router->post("dice100/stopRound", function () use ($app) {

//     $_SESSION["rollDiceGame"]->stopRound();

//     return $app->response->redirect("dice100/play");
// });

// $app->router->post("dice100/startRound", function () use ($app) {

//     $_SESSION["rollDiceGame"]->startRound();

//     return $app->response->redirect("dice100/play");
// });
