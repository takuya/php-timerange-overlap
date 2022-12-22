<?php

namespace Tests\PhpTimeOverlap\Units;

use Tests\PhpTimeOverlap\TestCase;
use Takuya\PhpTimeOverlap\TimeRange;
use DateTime;

class TimeRangeCompSuccessTest extends TestCase {
  
  public function test_time_range_comparison_same () {
    $plus_3min = \DateInterval::createFromDateString( '+3 min' );
    //
    $start = new \DateTime( '2022-2-22 22:22' );
    $end = ( clone $start )->add( $plus_3min );
    $a = new TimeRange( clone $start, clone $end );
    $b = new TimeRange( clone $start, clone $end );
    //
    $ret = $a->same( $b );
    $this->assertTrue( $ret );
  }
  
  public function test_time_range_comparison_same_immutable () {
    $plus_3min = \DateInterval::createFromDateString( '+3 min' );
    //
    $start = new \DateTimeImmutable( '2022-2-22 22:22' );
    $end = $start->add( $plus_3min );
    $a = new TimeRange( $start, $end );
    $b = new TimeRange( $start, $end );
    //
    $ret = $a->same( $b );
    $this->assertTrue( $ret );
  }
  
  public function test_time_range_comparison_before () {
    $plus_3min = \DateInterval::createFromDateString( '+3 min' );
    $plus_5min = \DateInterval::createFromDateString( '+5 min' );
    //
    $start = new DateTime( '2022-2-22 22:22' );
    $end = ( clone $start )->add( $plus_3min );
    $a = new TimeRange( clone $start, clone $end );
    $b = new TimeRange( ( clone $start )->add( $plus_5min ), ( clone $end )->add( $plus_5min ) );
    //
    $ret = $a->before( $b );
    $this->assertTrue( $ret );
  }
  
  public function test_time_range_comparison_before_immutable () {
    $plus_3min = \DateInterval::createFromDateString( '+3 min' );
    $plus_5min = \DateInterval::createFromDateString( '+5 min' );
    //
    $start = new \DateTimeImmutable( '2022-2-22 22:22' );
    $end = $start->add( $plus_3min );
    $a = new TimeRange( $start, $end );
    $b = new TimeRange( $start->add( $plus_5min ), $end->add( $plus_5min ) );
    //
    $ret = $a->before( $b );
    $this->assertTrue( $ret );
  }
  
  public function test_time_range_comparison_after () {
    $plus_3min = \DateInterval::createFromDateString( '+3 min' );
    $minus_5min = \DateInterval::createFromDateString( '-5 min' );
    //
    $start = new DateTime( '2022-2-22 22:22' );
    $end = ( clone $start )->add( $plus_3min );
    $a = new TimeRange( clone $start, clone $end );
    $b = new TimeRange( ( clone $start )->add( $minus_5min ), ( clone $end )->add( $minus_5min ) );
    //
    $ret = $a->after( $b );
    $this->assertTrue( $ret );
  }
  
  public function test_time_range_comparison_after_immutable () {
    $plus_3min = \DateInterval::createFromDateString( '+3 min' );
    $minus_5min = \DateInterval::createFromDateString( '-5 min' );
    //
    $start = new \DateTimeImmutable( '2022-2-22 22:22' );
    $end = $start->add( $plus_3min );
    $a = new TimeRange( $start, $end );
    $b = new TimeRange( $start->add( $minus_5min ), $end->add( $minus_5min ) );
    //
    $ret = $a->after( $b );
    $this->assertTrue( $ret );
  }
  public function test_time_range_comparison_contains_imutable () {
    $plus_1min = \DateInterval::createFromDateString( '+1 min' );
    $plus_3min = \DateInterval::createFromDateString( '+3 min' );
    $plus_5min = \DateInterval::createFromDateString( '+5 min' );
    //
    $start = new \DateTimeImmutable( '2022-2-22 22:22' );
    $end = $start->add( $plus_5min );
    $a = new TimeRange( $start, $end );
    $b = new TimeRange( $start->add( $plus_1min ), $start->add( $plus_3min ) );
    //
    $ret = $a->contains( $b );
    $this->assertTrue( $ret );
  }
  public function test_time_range_comparison_contains () {
    $plus_1min = \DateInterval::createFromDateString( '+1 min' );
    $plus_3min = \DateInterval::createFromDateString( '+3 min' );
    $plus_5min = \DateInterval::createFromDateString( '+5 min' );
    //
    $start = new \DateTime( '2022-2-22 22:22' );
    $end = (clone $start)->add( $plus_5min );
    $a = new TimeRange( clone $start, clone  $end );
    $b = new TimeRange( (clone $start)->add( $plus_1min ), (clone $start)->add( $plus_3min ) );
    //
    $ret = $a->contains( $b );
    $this->assertTrue( $ret );
  }
  public function test_time_range_comparison_during () {
    $plus_1min = \DateInterval::createFromDateString( '+1 min' );
    $plus_3min = \DateInterval::createFromDateString( '+3 min' );
    //
    $start = new \DateTime( '2022-2-22 22:22' );
    $end = (clone $start)->add( $plus_1min );
    $a = new TimeRange( clone $start, clone  $end );
    $b = new TimeRange( (clone $start)->sub( $plus_3min ), (clone $end)->add( $plus_3min ) );
    //
    $ret = $a->during( $b );
    $this->assertTrue( $ret );
  }
  public function test_time_range_comparison_during_immutable () {
    $plus_1min = \DateInterval::createFromDateString( '+1 min' );
    $plus_3min = \DateInterval::createFromDateString( '+3 min' );
    //
    $start = new \DateTimeImmutable( '2022-2-22 22:22' );
    $end = $start->add( $plus_1min );
    $a = new TimeRange( $start, $end );
    $b = new TimeRange( $start->sub( $plus_3min ), $end->add( $plus_3min ) );
    //
    $ret = $a->during( $b );
    $this->assertTrue( $ret );
  }
  public function test_time_range_comparison_overlaps_immutable () {
    $plus_1min = \DateInterval::createFromDateString( '+1 min' );
    $plus_3min = \DateInterval::createFromDateString( '+3 min' );
    //
    $start = new \DateTimeImmutable( '2022-2-22 22:22' );
    $end = $start->add( $plus_3min );
    $a = new TimeRange( $start, $end );
    $b = new TimeRange( $start->add( $plus_1min ), $end->add( $plus_3min ) );
    //
    $ret = $a->overlaps( $b );
    $this->assertTrue( $ret );
  }
  public function test_time_range_comparison_overlaps () {
    $plus_1min = \DateInterval::createFromDateString( '+1 min' );
    $plus_3min = \DateInterval::createFromDateString( '+3 min' );
    //
    $start = new \DateTimeImmutable( '2022-2-22 22:22' );
    $end = (clone$start)->add( $plus_3min );
    $a = new TimeRange( clone $start,  clone $end );
    $b = new TimeRange( (clone $start)->add( $plus_1min ), (clone $end)->add( $plus_3min ) );
    //
    $ret = $a->overlaps( $b );
    $this->assertTrue( $ret );
  }
  public function test_time_range_comparison_overlapped () {
    $plus_1min = \DateInterval::createFromDateString( '+1 min' );
    $plus_3min = \DateInterval::createFromDateString( '+3 min' );
    $minus_5min = \DateInterval::createFromDateString( '-5 min' );
    //
    $start = new \DateTimeImmutable( '2022-2-22 22:22' );
    $end = (clone $start)->add( $plus_3min );
    $a = new TimeRange( clone $start,  clone $end );
    $b = new TimeRange( (clone $start)->add( $minus_5min ), (clone $start)->add( $plus_1min ) );
    //
    $ret = $a->overlapped( $b );
    $this->assertTrue( $ret );
  }
  public function test_time_range_comparison_overlapped_immutable () {
    $plus_1min = \DateInterval::createFromDateString( '+1 min' );
    $plus_3min = \DateInterval::createFromDateString( '+3 min' );
    $minus_5min = \DateInterval::createFromDateString( '-5 min' );
    //
    $start = new \DateTimeImmutable( '2022-2-22 22:22' );
    $end = $start->add( $plus_3min );
    $a = new TimeRange( $start,  $end );
    $b = new TimeRange( $start->add( $minus_5min ), $start->add( $plus_1min ) );
    //
    $ret = $a->overlapped( $b );
    $this->assertTrue( $ret );
  }
  
  
}


































