<!--list employees server side using php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>put while in HTML</title>
    <style>
        ul {
            display: table;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <?php
        $employees = array('John', 'Michelle', 'Mari', 'Luke', 'Nellie');

        /* or you could just do
        $employees = ['John', 'Michelle', 'Mari', 'Luke', 'Nellie']; */

        $total = count($employees);
    ?>
     <h1 align="center" >List of Employees</h1>
    <ul> <!-- Unordered list of items -->
    <?php
        $i = 0;

        while ($i < $total) {
    ?>
    <li> <!-- List items -->
    <?php 
        echo $employees[$i];
        $i++;
    ?>
    </li>
    <?php
        }
    ?>
    </ul>
</body>
</html>