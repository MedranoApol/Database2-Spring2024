<!-- HW5 Q1 A, B, & C : booksa database -->
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>booksa</title>
</head>
<body>
    <?php 
    //connect to myPHPadmin SQL Server
    $dbc = @mysqli_connect('localhost', 'root', '');

    //drop database if it exists
    $query = "DROP DATABASE IF EXISTS booksa";

    if (!mysqli_query($dbc, $query))
        echo "Error in dropping the database: " . mysqli_error($dbc);

    //query to create DATABASE booksa
    $query = "CREATE DATABASE booksa";

    if (!mysqli_query($dbc, $query))
        echo "Error creating database: " . mysqli_error($dbc);

    //select booksa to use
    $query = "USE booksa";

    if (!mysqli_query($dbc, $query))
        echo "Error selecting database: " . mysqli_error($dbc);

    //query to create TABLE books
    $query = "CREATE TABLE IF NOT EXISTS books(
        t_id INT AUTO_INCREMENT,
        title VARCHAR(255) NOT NULL,
        pages INT NOT NULL,
        PRIMARY KEY (t_id)
        )";

    if (!mysqli_query($dbc, $query))
        echo "Error creating car table: " . mysqli_error($dbc);

    //query to add VALUES to books TABLE 
    $query = "INSERT INTO books VALUES
    (DEFAULT, 'Mathematics', 120),
    (DEFAULT, 'Python', 150)";

    if (!mysqli_query($dbc, $query))
        echo "Error inserting data into books table: " . mysqli_error($dbc);

    //query to create make TABLE 
    $query = "CREATE TABLE IF NOT EXISTS authors(
        a_id INT AUTO_INCREMENT,
        lname VARCHAR(50) NOT NULL,
        fname VARCHAR(50) NOT NULL,
        PRIMARY KEY (a_id)
        )";

    if (!mysqli_query($dbc, $query))
        echo "Error creating make table: " . mysqli_error($dbc);

    //query to add VALUES to make table 
    $query = "INSERT INTO authors VALUES
    (DEFAULT, 'Star', 'Ellen'),
    (DEFAULT, 'Arct', 'Peter'),
    (DEFAULT, 'Mata', 'Victor'),
    (DEFAULT, 'Mark', 'Paul')";

    if (!mysqli_query($dbc, $query))
        echo "Error inserting data into authors table: " . mysqli_error($dbc);

    //query to create book_and_author TABLE
    $query = "CREATE TABLE IF NOT EXISTS book_and_author(
        book_id INT,
        author_id INT,
        FOREIGN KEY (book_id) REFERENCES books(t_id),
        FOREIGN KEY (author_id) REFERENCES authors(a_id)
        )";
    
    if (!mysqli_query($dbc, $query))
        echo "Error creating owner table: " . mysqli_error($dbc);

    //query to add VALUES to book_and_author TABLE 
    $query = "INSERT INTO book_and_author VALUES
    (1, 1),
    (1, 2),
    (2, 3),
    (2, 4)";

    if (!mysqli_query($dbc, $query))
        echo "Error inserting data into make table: " . mysqli_error($dbc);
    
    // get the query to display values
    $query = "SELECT books.title, authors.fname, authors.lname, books.pages FROM books
    JOIN book_and_author as BA ON books.t_id = BA.book_id
    JOIN authors ON BA.author_id = authors.a_id
    ORDER BY books.t_id";

    //run the query
    $result = mysqli_query($dbc, $query);

    //count the number of returned rows
    $num = mysqli_num_rows($result);

    if ($num > 0)
    {

        //shows all values in car table
        while ($row = mysqli_fetch_assoc($result)) 
            echo '<p>Title: ' . $row['title'] . '<br>
            Author: ' . $row['fname'] . ' ' . $row['lname'] . '<br>
            Pages: ' . $row['pages'] . '<br></p>';

        mysqli_free_result($result); //free up space

    } elseif ($result) { //empty query result

        echo "Query returned zero results";
        mysqli_free_result($result); //free up space

    } else { //error with query
        echo "Error retrieving query result: " . mysqli_error($dbc);
    }

    mysqli_close($dbc);
?>
</body>
</html>