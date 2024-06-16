<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logged In</title>
</head>
<body>
<?php    

session_start();

// Check for a valid user ID, through GET or POST:
if ((isset($_SESSION['name'])) && (!empty($_SESSION['name']))) 
{
    $name = $_SESSION['name']; 
} 
else 
{    
    echo '<p class="error">This page has been accessed in error.</p>';
    exit();
}

echo "<h1 align=\"center\">Welcome $name</h1>";
?>

<form action="login.php" method="get">
<p align="center"><input type="submit" name="Submit" value="logout"></p>
</form>

<?php
$_SESSION = [];
session_destroy();
setcookie('PHPSESSID', '', time()-3600, '/', '', 0, 0);
?>
</body>
</html>