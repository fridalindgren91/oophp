<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init game and redirect to play..
 */
$app->router->get("guess/init", function () use ($app) {
    // Init session
    //$game = new \Frida\Guess\Guess();

    return $app->response->redirect("guess/play");
});



/**
 * Play game
 */
$app->router->get("guess/play", function () use ($app) {

    if (!isset($_SESSION["game"])) {
        $_SESSION["game"] = new \Frida\Guess\Guess();
    }

    if (!isset($_SESSION["res"])) {
        $_SESSION["res"] = "";
    }

    $title = "Play the game";

    $data = [
        "res" => $_SESSION["res"],
        "tries" => $_SESSION["game"]->tries
    ];

    $app->page->add("guess/play", $data);

    return $app->page->render([
        "title" => $title,
    ]);
});

$app->router->post("guess/cheat", function () use ($app) {

    $_SESSION["res"] = $_SESSION["game"]->doCheat();

    return $app->response->redirect("guess/play");
});

$app->router->post("guess/restart", function () use ($app) {

    session_destroy();

    return $app->response->redirect("guess/play");
});

$app->router->post("guess/guess", function () use ($app) {
    $_SESSION["res"] = $_SESSION["game"]->makeGuess($_POST["guess"]);

    return $app->response->redirect("guess/play");
});
