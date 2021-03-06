<?php
namespace Anax\View;

if (!$resultset) {
    return;
}

?>
<h3>Blog</h3>
<a href="<?= url("blog") ?>">Visa alla bloggposter</a><br>
<a href="<?= url("blog/addPage") ?>">Lägg till bloggpost</a><br>
<a href="<?= url("blog/reset") ?>">Återställ</a><br>
<a href="<?= url("pages") ?>">Visa pages</a><br>
<a href="<?= url("posts") ?>">Visa posts</a><br><br>
<form method="get" action="<?= url("blog/search") ?>">
    <fieldset>
    <legend>Sök efter bloggpost</legend>
    <p>
        <label>Titel:
            <input type="search" name="searchTitle" placeholder="Titel"/>
        </label>
    </p>
    <p>
        <input type="submit" value="Sök">
    </p>
    </fieldset>
</form><br>

<table class="blog">
    <tr class="first">
        <!-- <th>Rad</th> -->
        <th>Id</th>
        <th>Title</th>
        <th>Path</th>
        <th>Slug</th>
        <!-- <th>Type</th> -->
        <th>Published</th>
        <th>Created</th>
        <th>Updated</th>
        <th>Deleted</th>
        <th>Action</th>
    </tr>
    <?php $id = -1; foreach ($resultset as $row) :
        $id++;
        ?>
    <tr>
        <!-- <td><?= $id ?></td> -->
        <td><?= $row->id ?></td>
        <td><?= $row->title ?></td>
        <td><?= $row->path ?></td>
        <td><?= $row->slug ?></td>
        <!-- <td><?= $row->type ?></td> -->
        <td><?= $row->published ?></td>
        <td><?= $row->created ?></td>
        <td><?= $row->updated ?></td>
        <td><?= $row->deleted ?></td>
        <td>
            <form method="get" action="<?= url("blog/delete")?>">
                <input type="hidden" name="blogID" value="<?= $row->id ?>">
                <input type="submit" value="&#10006;">
            </form>
            <form method="get" action="<?= url("blog/editPage")?>">
                <input type="hidden" name="blogID" value="<?= $row->id ?>">
                <input type="submit" value="&#9998;">
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
