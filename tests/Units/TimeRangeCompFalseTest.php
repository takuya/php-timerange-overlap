<?php

namespace Tests\PhpTimeOverlap\Units;

use Tests\PhpTimeOverlap\TestCase;
use Takuya\PhpTimeOverlap\TimeRange;
use DateTime;

class TimeRangeCompFalseTest extends TestCase {
  
  public function test_time_range_comparison_same_by_other_methods_return_false () {
    $plus_3min = \DateInterval::createFromDateString( '+3 min' );
    //
    $start = new \DateTimeImmutable( '2022-2-22 22:22' );
    $end = $start->add( $plus_3min );
    $a = new TimeRange( $start, $end );
    $b = new TimeRange( $start, $end );
    //
    $this->assertTrue( $a->same( $b ) );
    $this->assertFalse( $a->after( $b ) );
    $this->assertFalse( $a->before( $b ) );
    $this->assertFalse( $a->contains( $b ) );
    $this->assertFalse( $a->during($b ) );
    $this->assertFalse( $a->overlapped($b ) );
    $this->assertFalse( $a->overlaps($b ) );
  }
  
  public function test_time_range_comparison_before_by_others_return_false () {
    $plus_3min = \DateInterval::createFromDateString( '+3 min' );
    $plus_5min = \DateInterval::createFromDateString( '+5 min' );
    //
    $start = new \DateTimeImmutable( '2022-2-22 22:22' );
    $end = $start->add( $plus_3min );
    $a = new TimeRange( $start, $end );
    $b = new TimeRange( $start->add( $plus_5min ), $end->add( $plus_5min ) );
    //
    $this->assertFalse( $a->same( $b ) );
    $this->assertFalse( $a->after( $b ) );
    $this->assertTrue( $a->before( $b ) );
    $this->assertFalse( $a->contains( $b ) );
    $this->assertFalse( $a->during($b ) );
    $this->assertFalse( $a->overlapped($b ) );
    $this->assertFalse( $a->overlaps($b ) );
  }
  public function test_time_range_comparison_after__by_others_return_false() {
    $plus_3min = \DateInterval::createFromDateString( '+3 min' );
    $minus_5min = \DateInterval::createFromDateString( '-5 min' );
    //
    $start = new \DateTimeImmutable( '2022-2-22 22:22' );
    $end = $start->add( $plus_3min );
    $a = new TimeRange( $start, $end );
    $b = new TimeRange( $start->add( $minus_5min ), $end->add( $minus_5min ) );
    //
    $this->assertFalse( $a->same( $b ) );
    $this->assertTrue( $a->after( $b ) );
    $this->assertFalse( $a->before( $b ) );
    $this->assertFalse( $a->contains( $b ) );
    $this->assertFalse( $a->during($b ) );
    $this->assertFalse( $a->overlapped($b ) );
    $this->assertFalse( $a->overlaps($b ) );
  }
  public function test_time_range_comparison_contains_by_others_return_false () {
    $plus_1min = \DateInterval::createFromDateString( '+1 min' );
    $plus_3min = \DateInterval::createFromDateString( '+3 min' );
    $plus_5min = \DateInterval::createFromDateString( '+5 min' );
    //
    $start = new \DateTimeImmutable( '2022-2-22 22:22' );
    $end = $start->add( $plus_5min );
    $a = new TimeRange( $start, $end );
    $b = new TimeRange( $start->add( $plus_1min ), $start->add( $plus_3min ) );
    //
    $this->assertFalse( $a->same( $b ) );
    $this->assertFalse( $a->after( $b ) );
    $this->assertFalse( $a->before( $b ) );
    $this->assertTrue( $a->contains( $b ) );
    $this->assertFalse( $a->during($b ) );
    $this->assertFalse( $a->overlapped($b ) );
    $this->assertFalse( $a->overlaps($b ) );
  }
  
  
  public function test_time_range_comparison_during_by_others_return_false () {
    $plus_1min = \DateInterval::createFromDateString( '+1 min' );
    $plus_3min = \DateInterval::createFromDateString( '+3 min' );
    //
    $start = new \DateTimeImmutable( '2022-2-22 22:22' );
    $end = $start->add( $plus_1min );
    $a = new TimeRange( $start, $end );
    $b = new TimeRange( $start->sub( $plus_3min ), $end->add( $plus_3min ) );
    //
    //
    $this->assertFalse( $a->same( $b ) );
    $this->assertFalse( $a->after( $b ) );
    $this->assertFalse( $a->before( $b ) );
    $this->assertFalse( $a->contains( $b ) );
    $this->assertTrue( $a->during($b ) );
    $this->assertFalse( $a->overlapped($b ) );
    $this->assertFalse( $a->overlaps($b ) );
  }
  public function test_time_range_comparison_overlaps_by_others_return_false () {
    $plus_1min = \DateInterval::createFromDateString( '+1 min' );
    $plus_3min = \DateInterval::createFromDateString( '+3 min' );
    //
    $start = new \DateTimeImmutable( '2022-2-22 22:22' );
    $end = $start->add( $plus_3min );
    $a = new TimeRange( $start, $end );
    $b = new TimeRange( $start->add( $plus_1min ), $end->add( $plus_3min ) );
    //
    $this->assertFalse( $a->same( $b ) );
    $this->assertFalse( $a->after( $b ) );
    $this->assertFalse( $a->before( $b ) );
    $this->assertFalse( $a->contains( $b ) );
    $this->assertFalse( $a->during($b ) );
    $this->assertFalse( $a->overlapped($b ) );
    $this->assertTrue( $a->overlaps($b ) );
  }
  
  
  public function test_time_range_comparison_overlapped_by_others_return_false () {
    $plus_1min = \DateInterval::createFromDateString( '+1 min' );
    $plus_3min = \DateInterval::createFromDateString( '+3 min' );
    $minus_5min = \DateInterval::createFromDateString( '-5 min' );
    //
    $start = new \DateTimeImmutable( '2022-2-22 22:22' );
    $end = $start->add( $plus_3min );
    $a = new TimeRange( $start,  $end );
    $b = new TimeRange( $start->add( $minus_5min ), $start->add( $plus_1min ) );
    //
    $this->assertFalse( $a->same( $b ) );
    $this->assertFalse( $a->after( $b ) );
    $this->assertFalse( $a->before( $b ) );
    $this->assertFalse( $a->contains( $b ) );
    $this->assertFalse( $a->during($b ) );
    $this->assertTrue( $a->overlapped($b ) );
    $this->assertFalse( $a->overlaps($b ) );
  }
  
}


































