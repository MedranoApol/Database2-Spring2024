<!--list employees server side using php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>put foreach in HTML</title>
    <style>
        ul {
            display: table;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <?php #use array
        $employees = array('John', 'Michelle', 'Mari', 'Luke', 'Nellie');

        /* or you could just do
        $employees = ['John', 'Michelle', 'Mari', 'Luke', 'Nellie']; */
    ?>
    <h1 align="center" >List of Employees</h1>
    <ul> <!-- Unordered list of items -->
    <?php
        foreach($employees as $employee) {
    ?>
    <li> <!-- List items -->
    <?php 
        echo $employee; 
    ?>
        </li>
    <?php 
        }
    ?>
    </ul>
</body>
</html>