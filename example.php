<?php

require (
    realpath(__DIR__ . "/vendor/autoload.php")
);

$database = file_get_contents(realpath("database.txt"));

$rules = array (
    'id'    => '1|2',
    'name'  =>'4|16',
    'phone' =>'21|10',
    'role'  =>'32|12'
);

$plaintext = new \FershoPls\Database\Plaintext\PlaintextTableManager();
$table = $plaintext->load($database)->toArray($rules);

print_r($table);