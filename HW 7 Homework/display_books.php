<?php
function displayQuery($option = "") {   
    $query = "";

    switch ($option) {
        case "name_asc":
            $query = "SELECT * FROM books ORDER BY author ASC";
            break;
        case "title_desc":
            $query = "SELECT * FROM books ORDER BY author DESC";
            break;
        case "title_asc":
            $query = "SELECT * FROM books ORDER BY title ASC";
            break;
        case "price_desc":
            $query = "SELECT * FROM books ORDER BY title DESC";
            break;
        case "price_asc":
            $query = "SELECT * FROM books ORDER BY price ASC";
            break;
        case "isbn_desc":
            $query = "SELECT * FROM books ORDER BY isbn DESC";
            break;
        case "isbn_asc":
            $query = "SELECT * FROM books ORDER BY isbn ASC";
            break;
        default:
            $query = "SELECT * FROM books ORDER BY author DESC";
            break;
    }
    return $query;
}
?>
<!DOCTYPE HTML>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <title>Display Books</title>
</head>
<body>
<h1>Display Books</h1>
<form action="display_books.php" method="post">
<p><label>Options</label>
<select name="display">
<option value="name_desc" <?php if (isset($_POST["display"]) && $_POST['display'] == 'name_desc') echo 'selected="selected"';?>>Author A-Z</option>
<option value="name_asc" <?php if (isset($_POST["display"]) && $_POST['display'] == 'name_asc') echo 'selected="selected"';?>>Author Z-A</option>
<option value="title_desc" <?php if (isset($_POST["display"]) && $_POST['display'] == 'title_desc') echo 'selected="selected"';?>>Title A-Z</option>
<option value="title_asc" <?php if (isset($_POST["display"]) && $_POST['display'] == 'title_asc') echo 'selected="selected"';?>>Title Z-A</option>
<option value="price_desc" <?php if (isset($_POST["display"]) && $_POST['display'] == 'price_desc') echo 'selected="selected"';?>>Price Descreasing</option>
<option value="price_asc" <?php if (isset($_POST["display"]) && $_POST['display'] == 'price_asc') echo 'selected="selected"';?>>Price Increasing</option>
<option value="isbn_desc" <?php if (isset($_POST["display"]) && $_POST['display'] == 'isbn_desc') echo 'selected="selected"';?>>ISBN Decreasing</option>
<option value="isbn_asc" <?php if (isset($_POST["display"]) && $_POST['display'] == 'isbn_asc') echo 'selected="selected"';?>>ISBN Increasing</option>
</p><p><input type="submit" name="Submit" value="Select"></p>

<?php
include("createDatabase.php");

//make connnect to the database
$dbc = @mysqli_connect("localhost", 'root', '', 'booksdb') OR die('Could not connect MySQL: ' . mysqli_connect_error() );

//make query
if (isset($_POST["display"]) && !empty($_POST["display"]))
    $query = displayQuery($_POST["display"]);
else
    $query = "SELECT * FROM books";

//execute query and get results
$result = mysqli_query($dbc, $query);
$num = mysqli_num_rows($result);

if ($num > 0){
    // creates table header
    echo '<table align="center" width=”60%” cellpadding="10">
    <thead>
    <tr align="center">
    <th align="center">ISBN</th>
    <th align="center">author</th>
    <th align="center">title</th>
    <th align="center">price</th>
    </tr>
    </thead>
    <tbody>';

    //fetch and display all data in tables
    while ($row = mysqli_fetch_assoc($result)){
        echo '<tr><td align="center">' . $row['isbn'] . 
        '</td><td align="center">' . $row['author'] . 
        '</td><td align="center">' . $row['title'] .
        '</td><td align="center">' . $row['price'] .
        '</td></tr>'; 
    }

    //close the table
    echo '</tbody><table>';
    mysqli_free_result($result); //free up space

} else if ($num == 0) { //empty result
    echo '<p align="center">No Results</p>';
    mysqli_free_result($result);
    
} else { //it it failed
    //message to user
    echo '<p class="error"><strong>Query failed.</strong></p>';
    //debug message
    echo '<p>' . mysqli_error($dbc) . '<br><br>Query: ' . $query . '</p>';
}

mysqli_close($dbc);

//gives you link to return to start_books3.html
echo '<p align="center"><a href="start_books3.html">Return to Selection Menu</a></p>';

?>
</form>
</body>
</html>