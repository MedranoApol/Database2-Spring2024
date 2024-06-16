<?php
    //connect to myPHPadmin SQL Server
    $dbc = mysqli_connect('localhost', 'root', '');

    //query to create DATABASE booksa
    $query = "CREATE DATABASE IF NOT EXISTS mydb";

    if (!mysqli_query($dbc, $query))
        echo "Error creating database: " . mysqli_error($dbc);

    //select mydb to use
    $query = "USE mydb";

    if (!mysqli_query($dbc, $query))
        echo "Error selecting database: " . mysqli_error($dbc);

    //query to create TABLE mydb
    $query = "CREATE TABLE IF NOT EXISTS messages(
        id INT AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        message TEXT NOT NULL,
        date DATE NOT NULL,
        PRIMARY KEY (id)
        )";

    if (!mysqli_query($dbc, $query))
        echo "Error creating  table: " . mysqli_error($dbc);

    //Check for peter's entry
    $query = "SELECT name FROM messages WHERE name='peter'";
    $result = @mysqli_query($dbc, $query);
 
    if (mysqli_num_rows($result) == 0) {
        $query = "INSERT INTO messages VALUES
        (DEFAULT, 'peter', 'Hello all', NOW())";

        if (!mysqli_query($dbc, $query))
            echo "Error inserting data into messages table: " . mysqli_error($dbc);
    }

    //Check for paul's entry
    $query = "SELECT name FROM messages WHERE name='paul'";
    $result = @mysqli_query($dbc, $query);
 
    if (mysqli_num_rows($result) == 0) {
        $query = "INSERT INTO messages VALUES
        (DEFAULT, 'paul', 'Hello', NOW())";

        if (!mysqli_query($dbc, $query))
            echo "Error inserting data into messages table: " . mysqli_error($dbc);
    }

    //Check for melissa's entry
    $query = "SELECT name FROM messages WHERE name='melissa'";
    $result = @mysqli_query($dbc, $query);
 
    if (mysqli_num_rows($result) == 0) {
        $query = "INSERT INTO messages VALUES
        (DEFAULT, 'melissa', 'Hi', NOW())";

        if (!mysqli_query($dbc, $query))
            echo "Error inserting data into messages table: " . mysqli_error($dbc);
    }

    mysqli_close($dbc);
?>