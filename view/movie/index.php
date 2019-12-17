<?php
namespace Anax\View;

if (!$resultset) {
    return;
}

?>
<h3>Filmer</h2>
<a href="<?= url("movie") ?>">Visa alla filmer</a><br>
<a href="<?= url("movie/addPage") ?>">Lägg till film</a><br>
<a href="<?= url("movie/reset") ?>">Återställ</a><br><br>
<form method="get" action="<?= url("movie/search") ?>">
    <fieldset>
    <legend>Sök på titel eller årtal</legend>
    <p>
        <label>Titel:
            <input type="search" name="searchTitle" placeholder="Titel"/>
        </label>
    </p>
    <p>
        <label>Årtal:
            <input type="search" name="searchYear" placeholder="Årtal"/>
        </label>
    </p>
    <p>
        <input type="submit" value="Sök">
    </p>
    </fieldset>
</form><br>

<table>
    <tr class="first">
        <th>Rad</th>
        <th>Id</th>
        <th>Bild</th>
        <th>Titel</th>
        <th>År</th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++; ?>
    <tr>
        <td><?= $id ?></td>
        <td><?= $row->id ?></td>
        <td><img class="thumb" src="<?= url($row->image) ?>"></td>
        <td><?= $row->title ?></td>
        <td><?= $row->year ?></td>
        <td>
            <form method="get" action="<?= url("movie/delete")?>">
                <input type="hidden" name="movieID" value="<?= $row->id ?>">
                <input type="submit" value="&#10006;">
            </form>
            <form method="get" action="<?= url("movie/editPage")?>">
                <input type="hidden" name="movieID" value="<?= $row->id ?>">
                <input type="submit" value="&#9998;">
            </form>
        </td>
    </tr>
<?php endforeach; ?>
</table>
