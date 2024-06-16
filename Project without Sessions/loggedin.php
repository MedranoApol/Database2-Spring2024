<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logged In</title>
</head>
<body>

<?php    
// Check for a valid user ID, through GET or POST:
if ((isset($_GET['name'])) && (!empty($_GET['name']))) 
{
    $name = $_GET['name']; //accessed through href link
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

</body>
</html> 