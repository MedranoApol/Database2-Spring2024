<!DOCTYPE HTML>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>Testing PCRE</title>
</head>
<body>
<?php

if ($_SERVER["REQUEST_METHOD"] == 'POST'){

    $pattern = trim($_POST['pattern']);
    $subject = trim($_POST['subject']);

    echo "<p>The result of checking<br>$pattern<br>against<br>$subject<br>is";


    if (preg_match_all($pattern, $subject, $matches)) {
         echo 'TRUE!</p>';
         // print the matching
         echo '<pre>' . print_r($matches, 1) . '</pre>';
    } else { 
        echo 'FALSE!</p>';
    }
}
?> 

<form action="pcre.php" method="post">
    <p>Regular Expression Pattern: <input type="text" name="pattern" value="<?php
     if (isset($pattern)) echo htmlentities($pattern); ?>" size="40"> (include the delimiters) </p>
     <p>Test Subject: <input type="text" name="subject" value="<?php 
     if (isset($subject)) echo htmlentities($subject); ?>" size="40"></p>
     <input type="submit" name="submit" value="Test!">
</form>
</body>
</html>