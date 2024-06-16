<?php 
function getSort($sort = '')
{
    switch($sort)
    {
        case 'Name':
            return ' ORDER BY Name ASC';
            break;
        case 'User':
            return ' ORDER BY User ASC';
            break;
        case 'Pass':
            return ' ORDER BY Pass';
            break;
        default:
            return '';
            break;
    }
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print Names</title>
</head>
<body>
<form action='printNames2.php' method="post">
<p><label>Sort By: </label>
<select name="sort">
<option value="Name" <?php if (isset($_POST["sort"]) && $_POST['sort'] == 'Name') echo 'selected="selected"';?>>Name</option>
<option value="User" <?php if (isset($_POST["sort"]) && $_POST['sort'] == 'User') echo 'selected="selected"';?>>Username</option>
<option value="Pass" <?php if (isset($_POST["sort"]) && $_POST['sort'] == 'Pass') echo 'selected="selected"';?>>Password</option>
</p><p><input type="submit" name="Submit" value="Select"></p>
<?php
    $dbc = mysqli_connect("localhost", "root", "", "userdb") OR die('Could not connect MYSQL: ' . mysqli_connect_error());
    $query = 'SELECT * FROM userinfo';
    $sort = (isset($_POST['sort']) && !empty($_POST['sort'])) ? getSort($_POST['sort']) : getSort();
    $query = $query . $sort;
    if (!mysqli_query($dbc, $query))
        echo "Error creating database: " . mysqli_error($dbc);
    else
        $result = mysqli_query($dbc, $query);
    $num = mysqli_num_rows($result);
    if ($num > 0)
    {
        while ($row = mysqli_fetch_assoc($result))
        {
            echo '<p>Name: ' . $row['Name'] . '<br>
            Username: ' . $row['User'] . '<br>
            Password: ' . $row['Pass'] . '</p>';        
        }
    }
    elseif($result)
    {
        echo 'There are no results';
    }
    else
    {
        echo 'Error occured retrieving result: ' . mysqli_error($dbc);
    }

    mysqli_close($dbc);
?>
</body>
</html> 