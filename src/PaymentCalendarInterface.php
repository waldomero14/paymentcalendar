<?php

namespace PaymentCalendar;

use Datetime;

/**
 * Interface PaymentCalendarInterface.
 *
 * @package PaymentCalendar
 *
 * Declares the PaymentCalendar functions.
 */
interface PaymentCalendarInterface {

  /**
   * Generates the exported file.
   *
   * @param string $filename
   *   The location where the file will be saved.
   *
   * @return bool
   *   Returns true if the file was saved.
   */
  public function generateFile($filename);

  /**
   * Generates the info to be exported.
   *
   * @return array
   *   The array with the info.
   */
  public function generateInfo();

  /**
   * Getter function for the start date.
   *
   * @return \Datetime
   *   The start date object.
   */
  public function getStartDate();

  /**
   * Setter function for the start date.
   *
   * @param \Datetime $start_date
   *   The start date object.
   */
  public function setStartDate(Datetime $start_date);

  /**
   * Getter function for the interval.
   *
   * @return mixed
   *   The interval value.
   */
  public function getInterval();

  /**
   * Setter function for the interval.
   *
   * @param string $interval
   *   The interval value.
   */
  public function setInterval($interval);

}
