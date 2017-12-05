<?php
include("vendor/autoload.php");
include("phpconf_utils.php");
include("data_employees.php");

display_array('Employees', $employees);

$yearsToRetire = $employees->map(function($employee) {
    return 65 - $employee['age'];
});

display_array('Years to retire', $yearsToRetire);

$alreadyRetired = $employees->filter(function ($employee) {
    return (65 - $employee['age']) < 0;
});

display_array('Already retired', $alreadyRetired);

$willRetireSoon = $employees
    ->map(function ($person) {
        $person['years_to_retire'] = 65 - $person['age'];
        return $person;
    })
    ->filter(function ($person) {
        return $person['years_to_retire'] <= 10 && $person['years_to_retire'] > 0;
    })
    ->map(function($person) {
        return $person['name'];
    });

display_array('Will retire soon', $willRetireSoon);

$monthlyCostOfRetirees = $employees
    ->filter(function ($employee) {
        return $employee['age'] > 65;
    })
    ->map(function ($employee) {
        return $employee['salary'] * 0.5;
    })
    ->reduce(function ($carry, $pension) {
        return $carry + $pension;
    });

display_value('Monthly cost of retirees\' pension', $monthlyCostOfRetirees);

$filterOnlyRetired = function ($employee) {
    return $employee['age'] > 65;
};

$discoverEmail = function ($employee) {
    $employee['email'] = strtolower($employee['name']) . "@westeros.com";
    return $employee;
};

$calculatePension = function ($employee) {
    $employee['pension'] = $employee['salary'] * 0.5;
    return $employee;
};

$pensionFund = 6000;

$employees
    ->filter($filterOnlyRetired)
    ->map($discoverEmail)
    ->map($calculatePension)
    ->each(function ($invoice) use (&$pensionFund) {
        if($pensionFund < $invoice['pension']) {
            return false;
        }

        sendPensionInvoice($invoice['email'], $invoice['pension']);

        $pensionFund -= $invoice['pension'];
    });


$retirees = $employees
    ->where('age', '>=', 65);

display_array('Retirees (using where)', $retirees);


$emails = $employees
    ->map($discoverEmail)
    ->pluck('email');

display_array('E-mails', $emails);

$namesByEmail = $employees
    ->map($discoverEmail)
    ->pluck('name', 'email');

display_array('Names by e-mail', $namesByEmail);


$top3Salaries = $employees
    ->sortByDesc('salary')
    ->take(3);

display_array('Top 3 Salaries', $top3Salaries);

collect([
    ['name' => 'Eddard', 'house' => 'Stark'],
    ['name' => 'Arya', 'house' => 'Stark'],
    ['name' => 'Robert', 'house' => 'Baratheon'],
])->groupBy('house')->pluck('name');
// result: ['Stark' => ['Eddard', 'Arya'], 'Baratheon' => ['Robert']]

collect([1,2,3,4,5,6,7,8,9,10,11])->chunk(3);
// result: [[1,2,3], [4,5,6], [7,8,9], [10,11]]

