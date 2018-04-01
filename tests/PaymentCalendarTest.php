<?php

use PHPUnit\Framework\TestCase;
use PaymentCalendar\PaymentCalendar;

/**
 * Class PaymentCalendarTest.
 */
class PaymentCalendarTest extends TestCase {

  /**
   * Tests the start date is an instance of Datetime.
   */
  public function testPaymentCalendarStartDate() {
    $calendar = new PaymentCalendar();
    $this->assertInstanceOf(Datetime::class, $calendar->getStartDate());
  }

}
