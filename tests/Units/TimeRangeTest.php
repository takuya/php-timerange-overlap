<?php

namespace Tests\PhpTimeOverlap\Units;

use Tests\PhpTimeOverlap\TestCase;
use Takuya\PhpTimeOverlap\TimeRange;
use DateTime;

class TimeRangeTest extends TestCase {
  public function test_time_range_construct () {
    $now = new \DateTime();
    $now->setTimezone( new \DateTimeZone( 'JST' ) );
    $a = ( clone $now )->add( \DateInterval::createFromDateString( '-4 hours' ) );
    $b = ( clone $now )->add( \DateInterval::createFromDateString( '-3 hours' ) );
    $this->expectNotToPerformAssertions();
    new TimeRange( $a, $b );
  }
  public function test_time_range_construct_exceptions () {
    $now = new \DateTime();
    $now->setTimezone( new \DateTimeZone( 'JST' ) );
    $a = ( clone $now )->add( \DateInterval::createFromDateString( '-4 hours' ) );
    $b = ( clone $now )->add( \DateInterval::createFromDateString( '-3 hours' ) );
    $this->expectException( \InvalidArgumentException::class);
    new TimeRange( $b, $a );
  }
  
}


































