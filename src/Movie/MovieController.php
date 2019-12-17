<?php

namespace Frida\Movie;

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
class MovieController implements AppInjectableInterface
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
        return $this->app->response->redirect("movie/index");
    }

    public function indexActionGet() : object
    {
        $title = "Movie database | frlg18";

        $this->app->db->connect();
        $sql = "SELECT * FROM movie;";
        $res = $this->app->db->executeFetchAll($sql);
    
        $this->app->page->add("movie/index", [
            "resultset" => $res,
        ]);
    
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function searchActionGet() : object
    {
        $title = "Movie database | frlg18";

        $searchTitle = $_GET["searchTitle"];
        $searchYear = $_GET["searchYear"];

        $resultset;

        if (isset($searchTitle) && $searchTitle != "") {
            $this->app->db->connect();
            $sql = "SELECT * FROM movie WHERE title LIKE ?;";
            $resultset = $this->app->db->executeFetchAll($sql, ['%' . $searchTitle . '%']);
        } elseif (isset($searchYear)) {
            $this->app->db->connect();
            $sql = "SELECT * FROM movie WHERE year = ?;";
            $resultset = $this->app->db->executeFetchAll($sql, [$searchYear]);
        }

        $this->app->page->add("movie/index", [
            "resultset" => $resultset,
        ]);
    
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function deleteActionGet() : object
    {
        $title = "Movie database | frlg18";

        $movieID = $_GET["movieID"];

        $resultset;

        $this->app->db->connect();
        $sql = "DELETE FROM movie WHERE id = ?;";
        $this->app->db->execute($sql, [$movieID]);
        $sqlQuestion = "SELECT * FROM movie;";
        $resultset = $this->app->db->executeFetchAll($sqlQuestion);

        $this->app->page->add("movie/index", [
            "resultset" => $resultset,
        ]);
    
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function addPageActionGet() : object
    {
        $title = "Movie database | frlg18";

        $this->app->page->add("movie/add", [
            
        ]);
    
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function addActionGet() : object
    {
        $title = "Movie database | frlg18";

        $movieTitle = $_GET["addTitle"];
        $movieYear = $_GET["addYear"];

        $resultset;

        $this->app->db->connect();
        $sql = "INSERT INTO movie (title, year) VALUES (?, ?);";
        $this->app->db->execute($sql, [$movieTitle, $movieYear]);
        $sqlQuestion = "SELECT * FROM movie;";
        $resultset = $this->app->db->executeFetchAll($sqlQuestion);

        $this->app->page->add("movie/index", [
            "resultset" => $resultset,
        ]);
    
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function editPageActionGet() : object
    {
        $title = "Movie database | frlg18";

        $movieID = $_GET["movieID"];

        $this->app->page->add("movie/edit", [
            "movieID" => $movieID,
        ]);
    
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function editMovieActionGet() : object
    {
        $title = "Movie database | frlg18";

        $movieTitle = $_GET["editTitle"];
        $movieYear = $_GET["editYear"];
        $movieID = $_GET["movieID"];

        if (isset($movieTitle) && $movieTitle !== "") {
            $this->app->db->connect();
            $sql = "UPDATE movie SET title = ? WHERE id = ?;";
            $this->app->db->execute($sql, [$movieTitle, $movieID]);
        }

        if (isset($movieYear) && $movieYear !== "") {
            $this->app->db->connect();
            $sql = "UPDATE movie SET year = ? WHERE id = ?;";
            $this->app->db->execute($sql, [$movieYear, $movieID]);
        }

        $resultset;

        $this->app->db->connect();
        $sql = "SELECT * FROM `movie`;";
        $resultset = $this->app->db->executeFetchAll($sql);

        $this->app->page->add("movie/index", [
            "resultset" => $resultset,
        ]);
    
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function resetActionGet() : object
    {
        $title = "Movie database | frlg18";

        $this->app->db->connect();
        $sql1 = "DROP TABLE IF EXISTS `movie`;";
        $sql2 = ("CREATE TABLE `movie`
        (
            `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
            `title` VARCHAR(100) NOT NULL,
            `director` VARCHAR(100),
            `length` INT DEFAULT NULL,
            `year` INT NOT NULL DEFAULT 1900,
            `plot` TEXT,
            `image` VARCHAR(100) DEFAULT NULL,
            `subtext` CHAR(3) DEFAULT NULL,
            `speech` CHAR(3) DEFAULT NULL,
            `quality` CHAR(3) DEFAULT NULL,
            `format` CHAR(3) DEFAULT NULL
        ) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;");
        $sql3 = "DELETE FROM `movie`;";
        $sql4 = ("INSERT INTO `movie` (`title`, `year`, `image`) VALUES
            ('Pulp fiction', 1994, 'img/pulp-fiction.jpg'),
            ('American Pie', 1999, 'img/american-pie.jpg'),
            ('Pokémon The Movie 2000', 1999, 'img/pokemon.jpg'),  
            ('Kopps', 2003, 'img/kopps.jpg'),
            ('From Dusk Till Dawn', 1996, 'img/from-dusk-till-dawn.jpg');");
        $sql5 = "SELECT * FROM `movie`;";

        $this->app->db->execute($sql1);
        $this->app->db->execute($sql2);
        $this->app->db->execute($sql3);
        $this->app->db->execute($sql4);
        $resultset = $this->app->db->executeFetchAll($sql5);
        
        $this->app->page->add("movie/index", [
            "resultset" => $resultset,
        ]);
    
        return $this->app->page->render([
            "title" => $title,
        ]);
    }
}
