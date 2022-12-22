<?php

namespace Tests\PhpTimeOverlap\Units;

use Tests\PhpTimeOverlap\TestCase;
use Takuya\PhpTimeOverlap\TimeRange;

class TimeRangeOverlappingTest extends TestCase {
  
  public function test_time_same_has_overlapping(){
    $plus_3min = \DateInterval::createFromDateString( '+3 min' );
    //
    $start = new \DateTime( '2022-2-22 22:22' );
    $end = ( clone $start )->add( $plus_3min );
    $a = new TimeRange( clone $start, clone $end );
    $b = new TimeRange( clone $start, clone $end );
    //
    $this->assertTrue($a->same( $b ));
    $this->assertTrue($a->has_overlapping( $b ));
  }
  public function test_time_contains_has_overlapping(){
    $plus_1min = \DateInterval::createFromDateString( '+1 min' );
    $plus_3min = \DateInterval::createFromDateString( '+3 min' );
    $plus_5min = \DateInterval::createFromDateString( '+5 min' );
    //
    $start = new \DateTime( '2022-2-22 22:22' );
    $end = (clone $start)->add( $plus_5min );
    $a = new TimeRange( clone $start, clone  $end );
    $b = new TimeRange( (clone $start)->add( $plus_1min ), (clone $start)->add( $plus_3min ) );
    //
    $this->assertTrue($a->contains( $b ));
    $this->assertTrue($a->has_overlapping( $b ));
  }
  public function test_time_during_has_overlapping(){
    $plus_1min = \DateInterval::createFromDateString( '+1 min' );
    $plus_3min = \DateInterval::createFromDateString( '+3 min' );
    //
    $start = new \DateTime( '2022-2-22 22:22' );
    $end = (clone $start)->add( $plus_1min );
    $a = new TimeRange( clone $start, clone  $end );
    $b = new TimeRange( (clone $start)->sub( $plus_3min ), (clone $end)->add( $plus_3min ) );
    //
    $this->assertTrue($a->during( $b ));
    $this->assertTrue($a->has_overlapping( $b ));
  }
  public function test_time_overlaps_has_overlapping(){
    $plus_1min = \DateInterval::createFromDateString( '+1 min' );
    $plus_3min = \DateInterval::createFromDateString( '+3 min' );
    //
    $start = new \DateTimeImmutable( '2022-2-22 22:22' );
    $end = $start->add( $plus_3min );
    $a = new TimeRange( $start, $end );
    $b = new TimeRange( $start->add( $plus_1min ), $end->add( $plus_3min ) );
    $this->assertTrue($a->overlaps( $b ));
    //
    $this->assertTrue($a->has_overlapping( $b ));
  }
  public function test_time_overlapped_has_overlapping(){
    $plus_1min = \DateInterval::createFromDateString( '+1 min' );
    $plus_3min = \DateInterval::createFromDateString( '+3 min' );
    $minus_5min = \DateInterval::createFromDateString( '-5 min' );
    //
    $start = new \DateTimeImmutable( '2022-2-22 22:22' );
    $end = $start->add( $plus_3min );
    $a = new TimeRange( $start,  $end );
    $b = new TimeRange( $start->add( $minus_5min ), $start->add( $plus_1min ) );
    $this->assertTrue($a->overlapped( $b ));
    //
    $this->assertTrue($a->has_overlapping( $b ));
  }
  public function test_time_before_has_no_overlapping(){
    $plus_3min = \DateInterval::createFromDateString( '+3 min' );
    $plus_5min = \DateInterval::createFromDateString( '+5 min' );
    //
    $start = new \DateTimeImmutable( '2022-2-22 22:22' );
    $end = $start->add( $plus_3min );
    $a = new TimeRange( $start, $end );
    $b = new TimeRange( $start->add( $plus_5min ), $end->add( $plus_5min ) );
    $this->assertTrue($a->before( $b ));
    //
    $this->assertFalse($a->has_overlapping( $b ));
  }
  public function test_time_after_has_no_overlapping(){
    $plus_3min = \DateInterval::createFromDateString( '+3 min' );
    $minus_5min = \DateInterval::createFromDateString( '-5 min' );
    //
    $start = new \DateTimeImmutable( '2022-2-22 22:22' );
    $end = $start->add( $plus_3min );
    $a = new TimeRange( $start, $end );
    $b = new TimeRange( $start->add( $minus_5min ), $end->add( $minus_5min ) );
    $this->assertTrue($a->after( $b ));
    //
    $this->assertFalse($a->has_overlapping( $b ));
  }
  
}