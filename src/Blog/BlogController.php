<?php

namespace Frida\Blog;

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
class BlogController implements AppInjectableInterface
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
        return $this->app->response->redirect("blog/index");
    }

    public function indexActionGet() : object
    {
        $title = "Blogg";

        $this->app->db->connect();
        $sql = "SELECT * FROM blog;";
        $res = $this->app->db->executeFetchAll($sql);

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
            
        $this->app->page->add("blog/index", [
            "resultset" => $res,
        ]);
    
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function searchActionGet() : object
    {
        $title = "Blogg";

        $searchTitle = $_GET["searchTitle"];

        $resultset;

        if (isset($searchTitle) && $searchTitle != "") {
            $this->app->db->connect();
            $sql = "SELECT * FROM blog WHERE title LIKE ?;";
            $resultset = $this->app->db->executeFetchAll($sql, ['%' . $searchTitle . '%']);
        }

        $this->app->page->add("blog/index", [
            "resultset" => $resultset,
        ]);
    
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function deleteActionGet() : object
    {
        $title = "Blogg";

        $blogID = $_GET["blogID"];

        $resultset;

        $this->app->db->connect();
        $sql = "UPDATE blog SET deleted = CURRENT_TIMESTAMP WHERE id = ?;";
        $this->app->db->execute($sql, [$blogID]);
        $sqlQuestion = "SELECT * FROM blog;";
        $resultset = $this->app->db->executeFetchAll($sqlQuestion);

        $this->app->page->add("blog/index", [
            "resultset" => $resultset,
        ]);
    
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function addPageActionGet() : object
    {
        $title = "Blogg";

        $this->app->page->add("blog/add", [
            
        ]);
    
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function addActionGet() : object
    {
        $title = "Blogg";

        $postTitle = $_GET["addTitle"];
        if ($_GET["addPath"] == null) {
            $postPath = $this->slugify($_GET["addSlug"]);
        } else {
            $postPath = $_GET["addPath"];
        }
        $postSlug = $this->slugify($_GET["addSlug"]);
        $postText = $_GET["addText"];        
        $postType = strtolower($_GET["addType"]);
        $postDate = $_GET["addDate"];

        $filter = "";

        if (isset($_GET["bbcode"])) {
            $bbcode = $_GET["bbcode"];
            $filter .= $bbcode . ", ";
        }
        if (isset($_GET["link"])) {
            $link = $_GET["link"];
            $filter .= $link . ", ";
        }
        if (isset($_GET["markdown"])) {
            $markdown = $_GET["markdown"];
            $filter .= $markdown . ", ";
        }
        if (isset($_GET["nl2br"])) {
            $nl2br = $_GET["nl2br"];
            $filter .= $nl2br;
        }

        $this->app->db->connect();
        if (isset($postSlug) && $postSlug != "") {
            $sqlSlug = "SELECT * FROM blog WHERE slug = ?";
            $slugRes = $this->app->db->executeFetchAll($sqlSlug, [$postSlug]);  
            if (count($slugRes) > 0) {
                echo "<script type='text/javascript'>alert('Det finns redan en post med denna slug, var snäll och ändra din.');</script>";
                $this->app->page->add("blog/add", [
                ]);
            
                return $this->app->page->render([
                    "title" => $title,
                ]);
            }  
        }

        $resultset;

        $this->app->db->connect();
        $sql = "INSERT INTO blog (title, path, slug, data, type, filter, published) VALUES (?, ?, ?, ?, ?, ?, ?);";
        $this->app->db->execute($sql, [$postTitle, $postPath, $postSlug, $postText, $postType, $filter, $postDate]);

        $sqlQuestion = "SELECT * FROM blog;";
        $resultset = $this->app->db->executeFetchAll($sqlQuestion);

        $this->app->page->add("blog/index", [
            "resultset" => $resultset,
        ]);
    
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function editPageActionGet() : object
    {
        $title = "Blogg";

        $postID = $_GET["blogID"];

        $this->app->db->connect();
        $sql = "SELECT * FROM blog WHERE id = ?";
        $res = $this->app->db->executeFetchAll($sql, [$postID]);

        $this->app->page->add("blog/edit", [
            "res" => $res,
            "postID" => $postID,
        ]);
    
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function editBlogActionGet() : object
    {
        $title = "Blogg";

        $postTitle = $_GET["editTitle"];
        $postPath = $_GET["editPath"];
        $postSlug = $_GET["editSlug"];
        $postText = $_GET["editText"];        
        $postType = $_GET["editType"];
        $postDate = $_GET["editDate"];
        $postID = $_GET["postID"];

        $filter = "";

        if (isset($_GET["bbcode"])) {
            $bbcode = $_GET["bbcode"];
            $filter .= $bbcode;
        }
        if (isset($_GET["link"])) {
            $link = $_GET["link"];
            $filter .= $link;
        }
        if (isset($_GET["markdown"])) {
            $markdown = $_GET["markdown"];
            $filter .= $markdown;
        }
        if (isset($_GET["nl2br"])) {
            $nl2br = $_GET["nl2br"];
            $filter .= $nl2br;
        }

        $this->app->db->connect();
        $sql = "UPDATE `blog` SET title = ?, path = ?, slug = ?, data = ?, type = ?, filter = ?, published = ? WHERE id = " . $postID . ";";
        $this->app->db->execute($sql, [$postTitle, $postPath, $postSlug, $postText, $postType, $filter, $postDate]);

        $resultset;

        echo "<script type='text/javascript'>alert('Din post är uppdaterad!);</script>";

        $this->app->db->connect();
        $sql = "SELECT * FROM `blog`;";
        $resultset = $this->app->db->executeFetchAll($sql);

        $this->app->page->add("blog/index", [
            "resultset" => $resultset,
        ]);
    
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function resetActionGet() : object
    {
        $title = "Blogg";

        $this->app->db->connect();

        $sql1 = "SET NAMES utf8;";
        //$sql2 = "USE oophp;";
        $sql3 = "DROP TABLE IF EXISTS `blog`;";
        $sql4 = "CREATE TABLE `blog`
        (
            `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
            `path` CHAR(120) UNIQUE,
            `slug` CHAR(120) UNIQUE,
            `title` VARCHAR(120),
            `data` TEXT,
            `type` CHAR(20),
            `filter` VARCHAR(80) DEFAULT NULL,
            `published` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
            `deleted` DATETIME DEFAULT NULL
        ) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;";

        // $sql5 = "USE oophp;";

        $sql6 = 'INSERT INTO `blog` (`path`, `slug`, `type`, `title`, `data`, `filter`) VALUES
        ("hem", null, "page", "Hem", "Detta är min hemsida. Den är skriven i [url=http://en.wikipedia.org/wiki/BBCode]bbcode[/url] vilket innebär att man kan formattera texten till [b]bold[/b] och [i]kursiv stil[/i] samt hantera länkar.\n\nDessutom finns ett filter som heter nl2br som lägger in <br>-element istället för \\n, det är smidigt, man kan skriva texten precis som man tänker sig att den skall visas, med radbrytningar.", "bbcode,nl2br"),
        ("om", null, "page", "Om", "Detta är en sida om mig och min webbplats. Den är skriven i [Markdown](http://en.wikipedia.org/wiki/Markdown). Markdown innebär att du får bra kontroll över innehållet i din sida, du kan formattera och sätta rubriker, men du behöver inte bry dig om HTML.\n\nRubrik nivå 2\n-------------\n\nDu skriver enkla styrtecken för att formattera texten som **fetstil** och *kursiv*. Det finns ett speciellt sätt att länka, skapa tabeller och så vidare.\n\n###Rubrik nivå 3\n\nNär man skriver i markdown så blir det läsbart även som textfil och det är lite av tanken med markdown.", "markdown"),
        ("blogpost-1", "valkommen-till-min-blogg", "post", "Välkommen till min blogg!", "Detta är en bloggpost.\n\nNär det finns länkar till andra webbplatser så kommer de länkarna att bli klickbara.\n\nhttp://dbwebb.se är ett exempel på en länk som blir klickbar.", "link,nl2br"),
        ("blogpost-2", "nu-har-sommaren-kommit", "post", "Nu har sommaren kommit", "Detta är en bloggpost som berättar att sommaren har kommit, ett budskap som kräver en bloggpost.", "nl2br"),
        ("blogpost-3", "nu-har-hosten-kommit", "post", "Nu har hösten kommit", "Detta är en bloggpost som berättar att sommaren har kommit, ett budskap som kräver en bloggpost", "nl2br");';

        $sql7 = "SELECT * FROM `blog`;";

        $this->app->db->execute($sql1);
        //$this->app->db->execute($sql2);
        $this->app->db->execute($sql3);
        $this->app->db->execute($sql4);
        // $this->app->db->execute($sql5);
        $this->app->db->execute($sql6);
        $resultset = $this->app->db->executeFetchAll($sql7);
        
        $this->app->page->add("blog/index", [
            "resultset" => $resultset,
        ]);
    
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    private function slugify($str)
    {
        $str = mb_strtolower(trim($str));
        $str = str_replace(array('å','ä','ö'), array('a','a','o'), $str);
        $str = preg_replace('/[^a-z0-9-]/', '-', $str);
        $str = trim(preg_replace('/-+/', '-', $str), '-');
        return $str;
    }
}
