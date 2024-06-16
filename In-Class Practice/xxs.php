<!DOCTYPE HMTL>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>XXS Attacks</title>
</head>
<body>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (isset($_POST['data']) && !empty($_POST['data']))
    {
        echo '<h2>Orginal</h2><p>' . $_POST['data'] . '</p>';
        echo '<h2>After htmlentities()</h2><p>' . htmlentities($_POST['data']) . '</p>';
        echo '<h2>After strip tags()</h2><p>' . strip_tags($_POST['data']) . '</p>';
    }
    else
    {
        echo '<h3>No input. Try again!<h3>';
    }
}


?>
<form action="xxs.php" method="post">
<p>Do your worst! <textarea name="data" rows="3" cols="40"></textarea></p>
<div align="center"><input type="submit" name="submit" value="Submit"></div>
</form>
</body>
</html>