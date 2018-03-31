<?php
/**
 * Created by PhpStorm.
 * User: walter.velasquez
 * Date: 29/03/2018
 * Time: 2:38 PM
 */
namespace PaymentCalendar;

use Datetime;

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
  public function generateInfo();

  public function getStartDate();

  public function setStartDate(Datetime $start_date);

  public function getInterval();

  public function setInterval($interval);

}