<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Movies</title>
</head>
<body>
<table border="0" cellspacing="3" callpadding="3" align="center">
<thead>
    <tr>
        <th><h3>Rating</h3></th>
        <th><h3>Title</h3></th>
    </tr>
</thead>
<tbody>
<?php # sorting movies.php

// Create the array:
$movies = [
    'Casablanca' => 10,
    'To Kill a Mockingbird' => 10,
    'The English Patient' => 2,
    'Stranger than Fiction' => 9,
    'Story of the Weeping Camel' => 5,
    'Donnie Darko' => 7
];

// Display the movies in their original order:
echo '<p><tr><td colspan="2"><strong>Original order:</strong></td></tr>';
foreach ($movies as $movie => $rating)
{
    echo "<tr><td>$rating</td><td>$movie</td></tr><p>";
}

// Display the movies ordered by title:
ksort($movies);

echo '<p><tr><td colspan="2"><strong>Ordered by title:</strong></td></tr>';
foreach ($movies as $movie => $rating)
{
    echo "<tr><td>$rating</td><td>$movie</td></tr></p>";
}


// Display the movies ordered by rating:
arsort($movies);

echo '<p><tr><td colspan="2"><strong>Ordered by rating:</strong></td></tr>';
foreach ($movies as $movie => $rating)
{
    echo "<tr><td>$rating</td><td>$movie</td></tr></p>";
}

?>
</tbody>
</table>
</body>
</html>