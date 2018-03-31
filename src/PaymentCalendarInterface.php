<?php

namespace PaymentCalendar;

use Datetime;

/**
 * Interface PaymentCalendarInterface
 * @package PaymentCalendar
 *
 * Declares the PaymentCalendar functions.
 */
interface PaymentCalendarInterface {

  /**
   * Generates the exported file.
   *
   * @param $location
   *   The location where the file will be saved.
   *
   * @return mixed
   */
  public function generateFile($filename);

  /**
   * Generates the information to be exported.
   *
   * @param $start_date
   * @param $end_date
   *
   * @return array The array with the payment calendar information.
   * The array with the payment calendar information.
   *
   */

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
   * @return Datetime
   *   The start date object.
   */
  public function getStartDate();

  /**
   * Setter function for the start date.
   *
   * @param Datetime $start_date
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
   * @param $interval
   *   The interval value.
   */
  public function setInterval($interval);

}