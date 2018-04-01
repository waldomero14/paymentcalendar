<?php

namespace PaymentCalendar;

use Datetime;
use DateInterval;

/**
 * Class PaymentCalendarBase.
 *
 * @package PaymentCalendar
 */
abstract class PaymentCalendarBase implements PaymentCalendarInterface {

  /**
   * The start date object.
   *
   * @var \Datetime
   */
  protected $startDate;

  /**
   * The interval value.
   *
   * @var mixed
   */
  protected $interval;

  public function __construct() {
    $this->startDate = new Datetime();
    $this->interval = 12;
  }

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
      // Get the next month object.
      $next_month_number = $last_day->format('n') + 1;
      $next_month_number = $last_day->format('Y') . '-' . $next_month_number . '-15';
      $next_month = Datetime::createFromFormat('Y-n-d', $next_month_number);

      // Modify the dates if needed.
      $salary = $this->resolveWeekendDays($last_day);
      $bonus = $this->resolveWeekendDays($next_month, 'bonus');

      $output[$i]['month'] = $salary->format('Y-F');
      $output[$i]['salary'] = $salary->format('Y-n-d');
      $output[$i]['bonus'] = $bonus->format('Y-n-d');

      // Increase the starting date.
      $this->startDate = $next_month;
    }

    return $output;
  }

  /**
   * Modifies the last day of the month if it is a weekend day.
   *
   * @param \Datetime $last_day
   *   The last day of the month object.
   * @param string $type
   *   The processed date type.
   *
   * @return \Datetime
   *   The modified Datetime object.
   */
  protected function resolveWeekendDays(Datetime $last_day, $type = 'salary') {
    $day_of_week = $last_day->format('N');

    if ($day_of_week > 5) {
      if ($type == 'salary') {
        $sub = $day_of_week - 5;
        $last_day->sub(new DateInterval('P' . $sub . 'D'));
      }
      elseif ($type == 'bonus') {
        $add = 10 - $day_of_week;
        $last_day->add(new DateInterval('P' . $add . 'D'));
      }
    }

    return $last_day;
  }

}
