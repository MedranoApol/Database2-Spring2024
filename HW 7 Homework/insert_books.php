<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insert Books</title>
</head>
<body>
<h1>Enter a Book</h1>
<form action="insert_books.php" method="post">
<p><label>ISBN <input type="number" name="ISBN" min="100000" max="999999" autocomplete="off"></label></p>
<p><label>Author <input type="text" name="author" size="10" maxlength="30" autocomplete="off"></label></p>
<p><label>Title <input type="text" name="title" size="15" maxlenght="30" autocomplete="off"></label></p>
<p><label>Price <input type="number" name="price" min="1" max="10000" autocomplete="off"></label></p>
<p><input type="submit" name="Submit" value="Enter"></p>
</form>
<?php
    include("createDatabase.php");

    $errors = []; //intialize error array

    //make connnect to the database
    $dbc = @mysqli_connect("localhost", 'root', '', 'booksdb') OR die('Could not connect MySQL: ' . mysqli_connect_error() );

    //if post is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if (empty($_POST["ISBN"])){ //if name was empty
            $errors = "ISBN is required";
        }
        if (empty($_POST["author"])){ //if message was empty
            $errors = "author is required";
        }
        if (empty($_POST["title"])){ //if name was empty
            $errors = "title is required";
        }
        if (empty($_POST["price"])){ //if message was empty
            $errors = "price is required";
        }

        if (empty($errors)){
            $stmt = mysqli_prepare($dbc, "INSERT INTO books (isbn, author, title, price) VALUES (?, ?, ?, ?)");

            //bind parameters
            mysqli_stmt_bind_param($stmt, "ssss", $ISBN, $author, $title, $price);

            //Set parameters and execute
            $ISBN = mysqli_real_escape_string($dbc, strtolower(trim($_POST['ISBN'])));
            $author = mysqli_real_escape_string($dbc, strtolower(trim($_POST['author'])));
            $title = mysqli_real_escape_string($dbc, trim($_POST['title']));
            $price = mysqli_real_escape_string($dbc, strtolower(trim($_POST['price'])));

            //execute statement
            if (mysqli_stmt_execute($stmt)) {
                echo "New record inserted successfully</br>";
            } else {
                echo "Error: " . mysqli_error($dbc);
            }
            
            // Close statement
            mysqli_stmt_close($stmt);
        }

    }

    //close connecition
    mysqli_close($dbc);

    // Display errors from NULL values
    if (!empty($errors)) {
        echo "<h3>Error List:</h3>";
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
    }

//gives you link to return to start_books3.html
echo '<p align="center"><a href="start_books3.html">Return to Selection Menu</a></p>';

?>
</body>
</html>