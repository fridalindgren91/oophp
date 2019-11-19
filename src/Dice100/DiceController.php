<?php

namespace Frida\Dice100;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class DiceController implements AppInjectableInterface
{
    use AppInjectableTrait;

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function debugAction() : string
    {
        // Deal with the action and return a response.
        return "Debug my game";
    }

    public function indexAction() : string
    {
        // Deal with the action and return a response.
        return "Index";
    }

    public function initAction() : string
    {
        return $this->app->response->redirect("dice100/play");
    }

    public function playActionGet() : object
    {
        if (!$this->app->session->has("rollDiceGame")) {
            $this->app->session->set("rollDiceGame", new Dice100());
        }

        $title = "Play the game";

        $data = [
            "number" => $this->app->session->get("rollDiceGame")->dice->number,
            "sum" => $this->app->session->get("rollDiceGame")->sum,
            "userTotalSum" => $this->app->session->get("rollDiceGame")->userTotalSum,
            "computerTotalSum" => $this->app->session->get("rollDiceGame")->computerTotalSum,
            "currentPlayer" => $this->app->session->get("rollDiceGame")->currentPlayer,
            "playing" => $this->app->session->get("rollDiceGame")->playing,
            "serie" => $this->app->session->get("rollDiceGame")->dice->printHistogram()
        ];

        $this->app->page->add("dice100/play", $data);

        return $this->app->page->render([
            "title" => $title
        ]);
    }

    public function restartActionPost() : object
    {
        session_destroy();

        return $this->app->response->redirect("dice100/play");
    }

    public function rollDiceActionPost() : object
    {
        $this->app->session->set("diceRes", $this->app->session->get("rollDiceGame")->roll());

        return $this->app->response->redirect("dice100/play");
    }

    public function stopRoundActionPost() : object
    {
        $this->app->session->get("rollDiceGame")->stopRound();

        return $this->app->response->redirect("dice100/play");
    }

    public function startRoundActionPost() : object
    {
        $this->app->session->get("rollDiceGame")->startRound();

        return $this->app->response->redirect("dice100/play");
    }
}
