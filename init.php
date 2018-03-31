<?php
/**
 * Created by PhpStorm.
 * User: walter.velasquez
 * Date: 29/03/2018
 * Time: 4:18 PM
 */

use PaymentCalendar\PaymentManager;
use PaymentCalendar\PaymentCalendar;

require 'vendor/autoload.php';

echo "Welcome to the payment calendar application.\n
The default settings are:
  - Start date is the current date
  - The number of months to be generated is 12
  - The filename is \"calendar.csv\"\n
  Do you want to change this settings? Type 'no' if you want to generate the file with the default settings: ";
$handle = fopen ("php://stdin","r");
$line = fgets($handle);
if (trim($line) != 'yes') {
  $start_date = '';

  $interval = 12;

  $filename = 'calendar';
}
else {
  while (empty($year)) {
    echo "Enter the starting year:\n";
    $handle = fopen("php://stdin", "r");
    $line = (int) fgets($handle);
    if (!$line) {
      echo "Enter a valid year value.\n";
    }
    else {
      $year = $line;
    }
  }

  while (empty($month)) {
    echo "Enter the starting month in numeric format:\n";
    $handle = fopen("php://stdin", "r");
    $line = (int) fgets($handle);
    if (!$line || $line > 12 || $line < 1) {
      echo "Enter a valid month value.\n";
    }
    else {
      $month = $line;
    }
  }

  $start_date = "$year-$month-15";

  while (empty($interval)) {
    echo "Enter the number of months you want to generate:\n";
    $handle = fopen("php://stdin", "r");
    $line = (int) fgets($handle);
    if (!$line || $line < 1) {
      echo "Enter a valid number value.\n";
    }
    else {
      $interval = $line;
    }
  }

  while (empty($filename)) {
    echo "Enter the filename without the extension:\n";
    $handle = fopen("php://stdin", "r");
    $line = fgets($handle);

    $filename = trim($line);
  }
}
echo "\n";
echo "Thank you, continuing...\n";

$calendar = new PaymentManager();
$calendar->setOutput(new PaymentCalendar(), $start_date, $interval);
$file = $calendar->generateOutput($filename);

if ($file) {
  echo "Thanks. The file \"$filename.csv\" is in the export folder.";
}