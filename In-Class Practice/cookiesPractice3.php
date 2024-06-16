<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cookie3</title>
</head>
<body>
<?php

setcookie('user', '', time()-3600, '/', '', 0, 0);
echo 'You are now logged out. You\'re cookies are now gone!';

echo '<a href="cookiesPractice1.php">Login</a>';
?>
</body>
</html>