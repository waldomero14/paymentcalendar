<?php

namespace PaymentCalendar;

use DateTime;
use DateInterval;

/**
 * Class PaymentCalendarBase
 * @package PaymentCalendar
 *
 * Abstract definition of the PaymentCalendar.
 */
abstract class PaymentCalendarBase implements PaymentCalendarInterface {

  /**
   * The start date object.
   *
   * @var DateTime
   */
  protected $startDate;

  /**
   * The interval value.
   *
   * @var mixed
   */
  protected $interval;

  /**
   * @inheritdoc
   */
  public function getStartDate() {
    return $this->startDate;
  }

  /**
   * @inheritdoc
   */
  public function setStartDate(Datetime $start_date) {
    $this->startDate = $start_date;
  }

  /**
   * @inheritdoc
   */
  public function getInterval() {
    return $this->interval;
  }

  /**
   * @inheritdoc
   */
  public function setInterval($interval) {
    $this->interval = $interval;
  }

  /**
   * @inheritdoc
   */
  public function generateFile($filename) {
    $header = $this->generateHeader();
    $info = $this->generateInfo();

    $fp = fopen("export/$filename.csv", 'w');

    fputcsv($fp, $header);
    foreach ($info as $fields) {
      fputcsv($fp, $fields);
    }

    fclose($fp);

    return TRUE;
  }

  /**
   * Generates the header structure.
   *
   * @return array
   *   The header structure array.
   */
  protected function generateHeader() {
    $header = [
      'month name',
      'salary payment date',
      'bonus payment date',
    ];

    return $header;
  }

  /**
   * @inheritdoc
   */
  public function generateInfo() {
    $output = [];

    for ($i = 0; $i < $this->interval; $i++) {
      // Creates a clone of the starting date.
      $last_day = clone $this->startDate;
      // Gets the last day of this month.
      $last_day = $last_day->modify('last day of this month');
      // Get the number of days of the next month.
      $next_month_number = $last_day->format('n') + 1;
      $next_month_number = $last_day->format('Y') . '-' . $next_month_number . '-15';
      $next_month = Datetime::createFromFormat('Y-m-d', $next_month_number);
      $number = $next_month->format('t');

      $salary = $this->resolveWeekendDays($last_day);
      $bonus = $this->resolveWeekendDays($next_month);

      $output[$i]['month'] = $salary->format('Y-F');
      $output[$i]['salary'] = $salary->format('Y-m-d');
      $output[$i]['bonus'] = $bonus->format('Y-m-d');

      // Increase the starting date.
      $interval = new DateInterval('P' . $number . 'D');
      $this->startDate->add($interval);
    }

    return $output;
  }

  /**
   * Modifies the last day of the month if it is a weekend day.
   *
   * @param DateTime
   *   The last day of the month object.
   *
   * @return DateTime
   *   The modified Datetime object.
   */
  protected function resolveWeekendDays(Datetime $last_day) {
    $day_of_week = $last_day->format('N');

    if ($day_of_week > 5) {
      $sub = $day_of_week - 5;
      $last_day->sub(new DateInterval('P' . $sub . 'D'));
    }

    return $last_day;
  }
}