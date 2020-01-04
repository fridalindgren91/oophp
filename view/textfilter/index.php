<?php
namespace Anax\View;

?>
<h3>Textfiltrering</h3>

<form method="get" action="<?= url("textfilter/parse") ?>">
    <fieldset>
    <legend>Välj filter</legend>
    <input type="checkbox" name="bbcode" value="bbcode" checked="checked"> bbcode<br>
    <input type="checkbox" name="link" value="link" checked="checked"> link<br>
    <input type="checkbox" name="markdown" value="markdown" checked="checked"> markdown<br>
    <input type="checkbox" name="nl2br" value="nl2br" checked="checked"> nl2br<br>
    <p>
        <input type="submit" value="Skicka">
    </p>
    </fieldset>
</form>

<?php
if (isset($textRes)) {
    echo "<p>" . $textRes . "</p>";
}