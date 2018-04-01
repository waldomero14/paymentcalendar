<?php

/**
 * @file
 * Init file of the payment calendar application.
 */

use PaymentCalendar\PaymentManager;
use PaymentCalendar\PaymentCalendar;

require 'vendor/autoload.php';

// Initial message.
echo "******************************************************************
Welcome to the payment calendar application.\n
The default settings are:
  - Start date is the current date
  - The number of months to be generated is 12
  Do you want to change this settings? Type 'no' if you want to generate the file with the default settings: ";
// Read and validate the value entered by the user.
$handle = fopen("php://stdin", "r");
$line = fgets($handle);
// If the user uses the default values, then they are set.
if (trim($line) != 'yes') {
  $start_date = '';

  $interval = 12;
}
else {
  // Gets and validates the year value.
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

  // Gets and validates the month value.
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

  // Builds the date value to follow the Y-n-d format.
  $start_date = "$year-$month-15";

  // Gets and validates the interval value.
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

}

// Gets and validates the filename value.
while (empty($filename)) {
  echo "Enter the filename without the extension:\n";
  $handle = fopen("php://stdin", "r");
  $line = fgets($handle);

  $filename = trim($line);
}

echo "\nThank you, continuing...\n";

// Creates the manager and sets the default calendar object.
$calendar = new PaymentManager();
$calendar->setPaymentCalendar(new PaymentCalendar(), $start_date, $interval);

// Generate the file.
$file = $calendar->generateOutput($filename);

if ($file) {
  echo "\nThanks. The file \"$filename.csv\" was created in the export folder.";
}
