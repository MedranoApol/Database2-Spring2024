<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Merge Assoc Arrays</title>
    <style>
    ul {
        text-align:center;
        list-style-position: inside;
    } 
    </style>
</head>
<body>
<?php  ######## MERGE ASSOCIATIVE ARRAYS ########

// Create one array:
$mexico = [
    'YU' => 'Yucatan',
    'BC' => 'Baja California',
    'OA' => 'Oaxaca'
];

// Create another array:
$us = [
    'MD' => 'Maryland',
    'IL' => 'Illinois',
    'PA' => 'Pennyslvania',
    'IA' => 'Iowa'
];

//  Create a third array:
$canada = [
    'QC' => 'Quebec',
    'AB' => 'Alberta',
    'NT' => 'Yukon',
    'PE' => 'Price Edward Island'
];


$north_america = [
    "Mexico" => $mexico,
    "United States" => $us,
    "Canada" => $canada
];

echo '<h2 align="center"> North America </h2>';
foreach ($north_america as $country_name => $country)
{
    echo "<p align=\"center\">Country: $country_name<br>";
    echo '<ul>';
    foreach ($country as $provinces => $prov_names)
        echo "<li align=\"center\">$provinces => $prov_names</li>";
    echo '</ul></p>';
}

?>
</body>
</html>