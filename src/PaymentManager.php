<?php
/**
 * Created by PhpStorm.
 * User: walter.velasquez
 * Date: 30/03/2018
 * Time: 10:22 PM
 */

namespace PaymentCalendar;

use Datetime;


class PaymentManager {

  private $output;

  public function setOutput(PaymentCalendarInterface $outputType, $start_date = '', $interval = 12) {
    $this->output = $outputType;
    // Create the datetime object.
    if (empty($start_date)) {
      $start_date = date('Y-n');
    }
    $date = Datetime::createFromFormat('Y-n-d', $start_date);
    $this->output->setStartDate($date);
    $this->output->setInterval($interval);
  }

  public function generateOutput($filename) {
    return $this->output->generateFile($filename);
  }

}