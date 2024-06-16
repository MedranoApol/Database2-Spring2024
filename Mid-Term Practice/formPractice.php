<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Practice</title>
</head>
<body>
    <h1>Enter your data</h1>

    <form action="notCreated.php" method="post">
    <p><label>Name: <input type="text" name="name" size="20" maxlength="40"></label></p>

    <p><label>Email Adress: <input type="email" name="email" size="40" maxlength="60"></label></p>

    <p><label for="gender">Gender:</label><input type="radio" name="gender" value="M">Male<input type="radio"
    name="gender" value="F">Female</p>

    <p><label>Age:
    <select name="age">
        <option value="0-29">Under 30</option>
        <option value="30-60">Between 30 and 60</option>
        <option value="60+">Over 60</option>
</select></label></p>

<p align="center"><input type="submit" name="Submit" value="Submit My Information"></p>

</form>
</body>
</html>