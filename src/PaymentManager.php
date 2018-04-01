<?php

namespace PaymentCalendar;

use Datetime;

/**
 * Class PaymentManager.
 *
 * @package PaymentCalendar
 */
class PaymentManager {

  /**
   * The PaymentCalendar object.
   *
   * @var \PaymentCalendar\PaymentCalendarInterface
   */
  private $paymentCalendar;

  /**
   * Sets the output object.
   *
   * @param \PaymentCalendarInterface $payment_calendar
   *   The PaymentCalendar object.
   * @param string $start_date
   *   The start date value.
   * @param mixed $interval
   *   The interval value.
   */
  public function setPaymentCalendar(PaymentCalendarInterface $payment_calendar, $start_date = '', $interval = 12) {
    $this->paymentCalendar = $payment_calendar;
    // Create the datetime object.
    if (empty($start_date)) {
      $start_date = date('Y-n-d');
    }
    $date = Datetime::createFromFormat('Y-n-d', $start_date);
    if (!$date instanceof Datetime) {
      return FALSE;
    }
    $this->paymentCalendar->setStartDate($date);
    $this->paymentCalendar->setInterval($interval);
  }

  /**
   * Generates the output file.
   *
   * @param string $filename
   *   The filename value.
   *
   * @return bool
   *   The result of the generation process.
   */
  public function generateOutput($filename) {
    return $this->paymentCalendar->generateFile($filename);
  }

}
