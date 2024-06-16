<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cookie2</title>
<head> 
<body>
<?php

if (!isset($_COOKIE["user"]))
{
    die("Invalid.");    
}
else
{
    echo "Cookie named: user\nValue:" . $_COOKIE['user'] . "<br>";
}
?>
<a href="cookiesPractice3.php">Logout</a>
</body>
</html>