<?php
include("vendor/autoload.php");
include("data_employees.php");

    $canSee = ['name', 'age'];
    $response = [];

    foreach($employees as $employee) {
        $item = [];

        foreach($canSee as $field) {
            if(!isset($employee[$field])) {
                continue;
            }

            $item[$field] = $employee[$field];
        }

        array_push($response, $item);

    }

    echo json_encode($response);


$canSee = ['name', 'age'];

echo $employees
    ->map(function ($employee) use ($canSee) {
        return collect($employee)->only($canSee);
    })
    ->toJson();