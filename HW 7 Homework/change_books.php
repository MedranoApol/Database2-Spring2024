<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Books</title>
</head>
<body>
<?php
include("createDatabase.php");

//make connnect to the database
$dbc = @mysqli_connect("localhost", 'root', '', 'booksdb') OR die('Could not connect MySQL: ' . mysqli_connect_error() );
$query = "SELECT * FROM books";

//execute query and get results
$result = mysqli_query($dbc, $query);
$num = mysqli_num_rows($result);

if ($num > 0){

    $errors = []; // Initialize an empty array to store errors

    // Check if the form has been sumbitted:
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        mysqli_free_result($result); //free up space

        if (empty($_POST["ISBN"]) && !isset($_POST["ISBN"])){ //if name was empty
            $errors[] = "ISBN is required";
        }
        if (empty($_POST["author"]) && !isset($_POST["author"])){ //if message was empty
            $errors[] = "author is required";
        }
        if (empty($_POST["title"]) && !isset($_POST["title"])){ //if name was empty
            $errors[] = "title is required";
        }
        if (empty($_POST["price"]) && !isset($_POST["price"])){ //if message was empty
            $errors[] = "price is required";
        }

        if (empty($errors)) { // if there are no errors
                
            $stmt = mysqli_prepare($dbc, "UPDATE books SET author=?, title=?, price=? WHERE isbn=?");

            //bind parameters
            mysqli_stmt_bind_param($stmt, "ssss", $author, $title, $price, $ISBN);

            //Set parameters and execute
            $author = mysqli_real_escape_string($dbc, strtolower(trim($_POST['author'])));
            $title = mysqli_real_escape_string($dbc, trim($_POST['title']));
            $price = mysqli_real_escape_string($dbc, strtolower(trim($_POST['price'])));
            $ISBN = mysqli_real_escape_string($dbc, strtolower(trim($_POST['ISBN'])));

            //execute statement
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt); // Close statement

                $result = mysqli_query($dbc, $query);
                $num = mysqli_num_rows($result);

                echo '<h1>Update a Book</h1>
                <form action="change_books.php" method="post">';

                while ($row = mysqli_fetch_assoc($result))
                    echo "<p><input type=\"radio\" name=\"ISBN\" value=\"". $row['isbn'] . "\">" . "Title: " . $row['title'] . "</p><p>&emsp;Author: " . $row['author'] . "</p><p>&emsp;Price: " . $row["price"] . "</p>";   

                echo'<p><label>Author <input type="text" name="author" size="10" maxlength="30" autocomplete="off"></label></p>
                <p><label>Title <input type="text" name="title" size="15" maxlenght="30" autocomplete="off"></label></p>
                <p><label>Price <input type="number" name="price" min="1" max="10000" autocomplete="off"></label></p>
                <p><input type="submit" name="Submit" value="Enter"></p>
                </form>';

                echo "New record updated successfully</br>";
            } else {
                echo "Error: " . mysqli_error($dbc);
            }
            

        } else { //Report the errors.

            echo "<h3>Error List:</h3>";
            echo "<ul>";
            foreach ($errors as $error) {
                echo "<li>$error</li>";
            }
            echo "</ul>"; 
        }
    }
    else
    {
        echo '<h1>Update a Book</h1>
                <form action="change_books.php" method="post">';

        while ($row = mysqli_fetch_assoc($result))
            echo "<p><input type=\"radio\" name=\"ISBN\" value=\"". $row['isbn'] . "\">" . "Title: " . $row['title'] . "</p><p>&emsp;Author: " . $row['author'] . "</p><p>&emsp;Price: " . $row["price"] . "</p>";  

        echo'<p><label>Author <input type="text" name="author" size="10" maxlength="30" autocomplete="off"></label></p>
        <p><label>Title <input type="text" name="title" size="15" maxlenght="30" autocomplete="off"></label></p>
        <p><label>Price <input type="number" name="price" min="1" max="10000" autocomplete="off"></label></p>
        <p><input type="submit" name="Submit" value="Enter"></p>
        </form>';

        mysqli_free_result($result); //free up space
    } 

} else if ($num == 0) { //empty result
    echo '<p align="center">Nothing to Update, Please Enter Some Books.</p>';
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
</body>
</html>