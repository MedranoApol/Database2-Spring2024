<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Predefined Variables</title>
</head>
<body>
<?php #Script 1.5 - Predifined.php

    //create a shorthand version
    $file = $_SERVER['SCRIPT_FILENAME'];

    $user = $_SERVER["HTTP_USER_AGENT"];

    $server = $_SERVER['SERVER_SOFTWARE'];

    //print the name of the user
    echo "<p>you are viewing this page using: <br><strong>$user</strong></p>\n";

    //print the server info
    echo "<p>this server is running: <br><strong>$server</strong></p>\n";

    //print the file name
    echo "<p>where this script is located: <br><strong>$file</strong></p>\n";

?>
</body>
</html>