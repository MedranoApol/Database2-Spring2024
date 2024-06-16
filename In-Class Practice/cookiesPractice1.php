<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cookie1</title>
<head> 
<body>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (isset($_POST['user']) && !empty($_POST['user']))
    {
        setcookie('user', $_POST['user'], time() + (86400 * 30));
        header("location: http://localhost/In-Class%20Practice/cookiesPractice2.php");
    }
    else
    {
        echo "Invalid input";
    }
}

?>
<form action="cookiesPractice1.php" method="post">
    <p><label>Insert Username: <input type="text" name="user"></label></p>
    <p><input type="submit" name="Submit" value="Login"></p>
</form>
</body>
</html>

