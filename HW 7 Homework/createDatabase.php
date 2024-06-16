<?php
//connect to myPHPadmin SQL Server
    $dbc = mysqli_connect('localhost', 'root', '');

    //query to create DATABASE booksa
    $query = "CREATE DATABASE IF NOT EXISTS booksdb";

    if (!mysqli_query($dbc, $query))
        echo "Error creating database: " . mysqli_error($dbc);

    //select booksdb to use
    $query = "USE booksdb";

    if (!mysqli_query($dbc, $query))
        echo "Error selecting database: " . mysqli_error($dbc);

    //query to create TABLE booksdb
    $query = "CREATE TABLE IF NOT EXISTS books(
        isbn INT PRIMARY KEY,
        author VARCHAR(255) NOT NULL,
        title VARCHAR(225)  NOT NULL,
        price INT  NOT NULL
        )";

    if (!mysqli_query($dbc, $query))
        echo "Error creating  table: " . mysqli_error($dbc);

    mysqli_close($dbc);
?>