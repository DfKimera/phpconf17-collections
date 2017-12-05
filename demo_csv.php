<?php

use Carbon\Carbon;

include("vendor/autoload.php");
include("phpconf_utils.php");


    $data = [];
    $headers = null;

    $csv = fopen("employees.csv", "r");

    while(($row = fgetcsv($csv)) !== false) {

        if(!$headers) {
            $headers = $row;
            continue;
        }

        $entry = [];

        foreach($row as $i => $value) {
            if(!isset($headers[$i])) {
                continue;
            }

            $entry[$headers[$i]] = $value;
        }

        if(!isset($entry['id'])) {
            continue;
        }

        $data[$entry['id']] = $entry;

    }

    display_array('Employees (with foreach)', $data);






    $csv = collect(file('employees.csv'))->map(function ($row) {
        return collect(str_getcsv($row, ","));
    });

    $data = $csv
        ->slice(1)
        ->map(function ($item) use ($csv) {
            return $csv->first()->combine($item)->toArray();
        })
        ->keyBy('id');

    display_array('Employees (with collections)', $data);

