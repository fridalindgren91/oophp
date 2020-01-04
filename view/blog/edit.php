<?php
namespace Anax\View;

if (!$res) {
    return;
}

?>

<h3>Redigera post</h2>
<a href="<?= url("blog") ?>">Visa alla poster</a><br><br>
<form method="get" action="<?= url("blog/editBlog") ?>">
    <fieldset>
    <?php foreach ($res as $res) : ?>
        <p>
            <label>Titel:
                <input type="text" name="editTitle" value="<?= $res->title ?>"/>
            </label>
        </p>
        <p>
            <label>Path:
                <input type="text" name="editPath" value="<?= $res->path ?>"/>
            </label>
        </p>
        <p>
            <label>Slug:
                <input type="text" name="editSlug" value="<?= $res->slug ?>"/>
            </label>
        </p>
        <p>
            <label>Text:
                <textarea name="editText"><?= $res->data ?></textarea>
            </label>
        </p>
        <p>
            <label>Type:
                <input type="text" name="editType" value="<?= $res->type ?>"/>
            </label>
        </p>
        <p>
            <label>Filter:<br>
                <?php
                if (strpos($res->filter, 'bbcode') !== false) {
                    echo "<input type='checkbox' name='bbcode' value='bbcode' checked='checked'> bbcode<br>";
                } else {
                    echo "<input type='checkbox' name='bbcode' value='bbcode'> bbcode<br>";
                }
                ?>
                <?php
                if (strpos($res->filter, 'link') !== false) {
                    echo "<input type='checkbox' name='link' value='link' checked='checked'> link<br>";
                } else {
                    echo "<input type='checkbox' name='link' value='link'> link<br>";
                }
                ?>
                <?php
                if (strpos($res->filter, 'markdown') !== false) {
                    echo "<input type='checkbox' name='markdown' value='markdown' checked='checked'> markdown<br>";
                } else {
                    echo "<input type='checkbox' name='markdown' value='markdown'> markdown<br>";
                }
                ?>
                <?php
                if (strpos($res->filter, 'nl2br') !== false) {
                    echo "<input type='checkbox' name='nl2br' value='nl2br' checked='checked'> nl2br<br>";
                } else {
                    echo "<input type='checkbox' name='nl2br' value='nl2br'> nl2br<br>";
                }
                ?>
            </label>
        </p>
        <p>
            <label>Publicerad:
                <input type="datetime-local" name="editDate" value="<?php echo str_replace(" ", "T", $res->published);?>"/>
            </label>
        </p>
            <input type="hidden" name="postID" value="<?= $postID ?>">
        <p>
            <input type="submit" value="Uppdatera">
        </p>
    <?php endforeach; ?>
    </fieldset>
</form><br>
