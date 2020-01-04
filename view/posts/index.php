<?php
namespace Anax\View;

if (!$resultset) {
    return;
}

?>
<h3>Posts</h3>
<div class="blog-menu">
    <a href="<?= url("blog") ?>">Visa alla bloggposter</a>
    <a href="<?= url("blog/addPage") ?>">Lägg till bloggpost</a>
    <a href="<?= url("blog/reset") ?>">Återställ</a>
    <a href="<?= url("pages") ?>">Visa pages</a><br><br>
</div>

    <?php $id = -1; foreach ($resultset as $row) :
        $id++;
        if ($row->updated == null) {
            $row->updated = $row->published;
        }
        ?>
    <h3><a href="<?= url("posts/" . $row->slug . "") ?>"><?= $row->title ?></a></h3>
    <p><i>Senast uppdaterad: <?= $row->updated ?></i></p>
    <p><?= $row->data ?></p>
    <?php endforeach; ?>
