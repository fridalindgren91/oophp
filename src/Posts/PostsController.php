<?php

namespace Frida\Posts;

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
class PostsController implements AppInjectableInterface
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
        return $this->app->response->redirect("posts/index");
    }

    public function catchAll(...$url) : object
    {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $slug = basename($url);

        $this->app->db->connect();
        $sql = "SELECT * FROM blog WHERE type = ? AND deleted IS NULL AND slug = ?;";
        $res = $this->app->db->executeFetchAll($sql, ["post", $slug]);

        $filterArr = array();

        foreach ($res as $row) :
            if (strpos($row->filter, 'bbcode') !== false) {
                array_push($filterArr, "bbcode");
            }
            if (strpos($row->filter, 'link') !== false) {
                array_push($filterArr, "link");
            }
            if (strpos($row->filter, 'markdown') !== false) {
                array_push($filterArr, "markdown");
            }
            if (strpos($row->filter, 'nl2br') !== false) {
                array_push($filterArr, "nl2br");
            }

            $textfilter = new \Frida\TextFilter\MyTextFilter();
            $row->title = $textfilter->parse($row->title, $filterArr);

            $textfilter = new \Frida\TextFilter\MyTextFilter();
            $row->data = $textfilter->parse($row->data, $filterArr);
        endforeach;
        
        $this->app->page->add("posts/post", [
            "args" => $slug,
            "resultset" => $res,
        ]);
    
        return $this->app->page->render([
        ]);
    }

    public function indexActionGet() : object
    {
        $title = "Posts";

        $this->app->db->connect();
        $sql = "SELECT * FROM blog WHERE type = ? AND deleted IS NULL;";
        $res = $this->app->db->executeFetchAll($sql, ["post"]);

        $filterArr = array();

        foreach ($res as $row) :
            if (strpos($row->filter, 'bbcode') !== false) {
                array_push($filterArr, "bbcode");
            }
            if (strpos($row->filter, 'link') !== false) {
                array_push($filterArr, "link");
            }
            if (strpos($row->filter, 'markdown') !== false) {
                array_push($filterArr, "markdown");
            }
            if (strpos($row->filter, 'nl2br') !== false) {
                array_push($filterArr, "nl2br");
            }

            $textfilter = new \Frida\TextFilter\MyTextFilter();
            $row->title = $textfilter->parse($row->title, $filterArr);

            $textfilter = new \Frida\TextFilter\MyTextFilter();
            $row->data = $textfilter->parse($row->data, $filterArr);
        endforeach;
            
        $this->app->page->add("posts/index", [
            "resultset" => $res,
        ]);
    
        return $this->app->page->render([
            "title" => $title,
        ]);
    }
}
