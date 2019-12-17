<?php
namespace Anax\View;

?>
<h3>Redigera film</h2>
<a href="<?= url("movie") ?>">Visa alla filmer</a><br><br>
<form method="get" action="<?= url("movie/editMovie") ?>">
    <fieldset>
    <p>
        <label>Titel:
            <input type="search" name="editTitle" placeholder="Titel"/>
        </label>
    </p>
    <p>
        <label>År:
            <input type="search" name="editYear" placeholder="Årtal"/>
        </label>
    </p>
        <input type="hidden" name="movieID" value="<?= $movieID ?>">
    <p>
        <input type="submit" value="Uppdatera">
    </p>
    </fieldset>
</form><br>
