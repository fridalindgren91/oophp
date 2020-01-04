<?php

namespace Frida\TextFilter;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class TextfilterController implements AppInjectableInterface
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
        return $this->app->response->redirect("textfilter/index");
    }

    public function indexActionGet() : object
    {
        $title = "Textfiltrering | frlg18";
    
        $this->app->page->add("textfilter/index", [
        ]);
    
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function parseActionGet() : object
    {
        $title = "Textfiltrering | frlg18";

        $text = "Detta är en text som testar mina funktioner på denna sida. Jag vill lägga till en klickbar länk till dbwebb: https://dbwebb.se/. \nDetta är en ny rad och jag kan använda [b]fet stil[/b], [i]kursiv stil[/i]. Följande är en url länk till min github: [url=https://github.com/fridalindgren91]Fridas GitHub[/url]. Här ska det visas en lista: \n\n* Hundar \n\n* Programmering \n\n* Vegansk mat";

        $filter = array();

        if (isset($_GET["bbcode"])) {
            $bbcode = $_GET["bbcode"];
            array_push($filter, $bbcode);
        }
        if (isset($_GET["link"])) {
            $link = $_GET["link"];
            array_push($filter, $link);
        }
        if (isset($_GET["markdown"])) {
            $markdown = $_GET["markdown"];
            array_push($filter, $markdown);
        }
        if (isset($_GET["nl2br"])) {
            $nl2br = $_GET["nl2br"];
            array_push($filter, $nl2br);
        }

        $this->myTextFilter = new MyTextFilter();
        $textRes = $this->myTextFilter->parse($text, $filter);

        $this->app->page->add("textfilter/index", [
            "textRes" => $textRes,
        ]);
    
        return $this->app->page->render([
            "title" => $title,
        ]);
    }
}
