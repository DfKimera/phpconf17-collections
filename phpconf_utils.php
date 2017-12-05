<!doctype html>
<html>
<head>
    <title>PHPConference 2017</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
</head>
<body>
<div class="container">
<?php
function display_array($title, $array) {

    $collection = collect($array);
    $firstRow = $collection->first();

    echo "<h4>{$title}</h4>";

    echo "<table class=\"table\">";
    echo "<thead>";
    echo "<tr>";
    echo "<th><span class='label label-default'>Index</span></th>";

    if(is_array($firstRow) && sizeof($firstRow) > 1) {
        foreach($firstRow as $column => $value) {
            echo "<th>{$column}</th>";
        }
    } else {
        echo "<th><span class='label label-default'>Value</span>";
    }

    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    foreach($collection as $i => $row) {

        echo "<tr>";

        echo "<td>{$i}</td>";

        if(is_array($row) && sizeof($row) > 0) {
            foreach ($row as $value) {
                echo "<td>{$value}</td>";
            }
        } else {
            echo "<td>{$row}</td>";
        }

        echo "</tr>";

    }

    echo "</tbody>";
    echo "</table>";

    echo "<hr />";


}

function display_value($title, $value) {

    echo "<h4>{$title}</h4>";

    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    echo "<hr />";


}

function sendPensionInvoice($email, $pension) {
    echo "<p><strong>Send e-mail to {$email} with retirement pension: {$pension}</strong>";
}