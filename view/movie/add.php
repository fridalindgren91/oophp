<?php
namespace Anax\View;

?>
<h3>Lägg till film</h2>
<a href="<?= url("movie") ?>">Visa alla filmer</a><br><br>
<form method="get" action="<?= url("movie/add") ?>">
    <fieldset>
    <p>
        <label>Titel:
            <input type="search" name="addTitle" placeholder="Titel"/>
        </label>
    </p>
    <p>
        <label>År:
            <input type="search" name="addYear" placeholder="Årtal"/>
        </label>
    </p>
    <p>
        <input type="submit" value="Lägg till">
    </p>
    </fieldset>
</form><br>
