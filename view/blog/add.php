<?php
namespace Anax\View;

?>
<h3>Lägg till bloggpost</h2>
<a href="<?= url("blog") ?>">Visa alla bloggposter</a><br><br>
<form method="get" action="<?= url("blog/add") ?>">
    <fieldset>
    <p>
        <label>Titel:
            <input type="text" name="addTitle" placeholder="Titel"/>
        </label>
    </p>
    <p>
        <label>Path:
            <input type="text" name="addPath" placeholder="Path"/>
        </label>
    </p>
    <p>
        <label>Slug:
            <input type="text" name="addSlug" placeholder="Slug"/>
        </label>
    </p>
    <p>
        <label>Text:
            <textarea name="addText"></textarea>
        </label>
    </p>
    <p>
        <label>Type:
            <input type="text" name="addType" placeholder="Type"/>
        </label>
    </p>
    <p>
        <label>Filter:<br>
            <input type="checkbox" name="bbcode" value="bbcode" checked="checked"> bbcode<br>
            <input type="checkbox" name="link" value="link" checked="checked"> link<br>
            <input type="checkbox" name="markdown" value="markdown" checked="checked"> markdown<br>
            <input type="checkbox" name="nl2br" value="nl2br" checked="checked"> nl2br<br>
        </label>
    </p>
    <p>
        <label>Publicerad:
            <input type="datetime-local" name="addDate" value="<?php echo date("Y-m-d").'T'.date('H:i:s');?>"/>
        </label>
    </p>
    <p>
        <input type="submit" value="Publicera">
    </p>
    </fieldset>
</form><br>
