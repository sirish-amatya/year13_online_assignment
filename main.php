<?php
require_once(__DIR__.'/Interface/TaxInterface.php');
require_once(__DIR__.'/Class/Item.php');
require_once(__DIR__.'/Class/BaseTax.php');
require_once(__DIR__.'/Class/ImportTax.php');
require_once(__DIR__.'/Class/Billing.php');
require_once(__DIR__.'/Class/Category.php');

//Validation for input file
if (isset($argv[1])) {
    $input_file = $argv[1]; //'input1.txt';
} else {
    die('Input file not given in argument!'.PHP_EOL);
}

//Initialize variables
$base_tax = new BaseTax();
$import_tax = new ImportTax();
$billing = new Billing();
$errors = array();

$handle = @fopen(__DIR__.'/Input/'.$input_file, 'r');
if (!is_resource($handle)) {
    die('Input file '.__DIR__.'/Input/'.$input_file.' could not be found!'.PHP_EOL);
}

$counter = 0;

//Index of $row: 0-Quantity, 1-Product Name, 2-Price
while ($row = @fgetcsv($handle)) {
    $counter++;

    //Ignoring first line
    if ($counter == 1) {
        continue;
    }

    try {
        $item = new Item($row[1], $row[2]);

        //Base tax is applicable on all products except few exemptions
        if (Category::isTaxApplicable($item)) {
            $item->applyTax($base_tax);
        }

        //Import tax is applicable in all imported products
        if (Category::isImported($item)) {
            $item->applyTax($import_tax);
        }
        
        $billing->addItem($item, $row[0]);
    } catch (Exception $e) {
        $errors[] = "Row:".$counter.", Message:".$e->getMessage();
    }
}

$billing->display();

if (!empty($errors)) {
    print PHP_EOL."Errors".PHP_EOL;
    print_r(implode(PHP_EOL, $errors));
    print PHP_EOL;
}
