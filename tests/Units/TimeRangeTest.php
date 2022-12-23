<?php

namespace Tests\PhpTimeOverlap\Units;

use Tests\PhpTimeOverlap\TestCase;
use Takuya\PhpTimeOverlap\TimeRange;
use DateTime;
use InvalidArgumentException;
use DateInterval;
use DateTimeZone;

class TimeRangeTest extends TestCase {
  public function test_time_range_construct () {
    $now = new DateTime();
    $now->setTimezone( new DateTimeZone( 'JST' ) );
    $a = ( clone $now )->add( DateInterval::createFromDateString( '-4 hours' ) );
    $b = ( clone $now )->add( DateInterval::createFromDateString( '-3 hours' ) );
    $this->expectNotToPerformAssertions();
    new TimeRange( $a, $b );
  }
  
  public function test_time_range_construct_exceptions () {
    $now = new DateTime();
    $now->setTimezone( new DateTimeZone( 'JST' ) );
    $a = ( clone $now )->add( DateInterval::createFromDateString( '-4 hours' ) );
    $b = ( clone $now )->add( DateInterval::createFromDateString( '-3 hours' ) );
    $this->expectException( InvalidArgumentException::class );
    new TimeRange( $b, $a );
  }
  
  public function test_sample_readme_code () {
    $a = new TimeRange( new DateTime( '22:22' ), new DateTime( '23:22' ) );
    $b = new TimeRange( new DateTime( '22:44' ), new DateTime( '23:44' ) );
    $ret = $a->has_overlapping( $b );
    $this->assertTrue( $ret );
    $a = new TimeRange( new DateTime( '2022-02-22' ), new DateTime( '2022-02-23' ) );
    $b = new TimeRange( new DateTime( '2022-02-20' ), new DateTime( '2022-02-24' ) );
    $ret = $a->has_overlapping( $b );
    $this->assertTrue( $ret );
  }
  
}


































