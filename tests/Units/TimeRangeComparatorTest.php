<?php

namespace Tests\PhpTimeOverlap\Units;

use Tests\PhpTimeOverlap\TestCase;
use Takuya\PhpTimeOverlap\TimeRange;
use DateTime;
use Takuya\PhpTimeOverlap\TimeRangeComparator;

class TimeRangeComparatorTest extends TestCase {
  
  public function test_compare_same () {
    $a = new TimeRange( new DateTime( '2022-2-22 22:22' ), new DateTime( '2022-2-22 22:25' ) );
    $b = new TimeRange( new DateTime( '2022-2-22 22:22' ), new DateTime( '2022-2-22 22:25' ) );
    $ret = TimeRangeComparator::isSame( $a, $b );
    $this->assertTrue( $ret );
  }
  
  public function test_compare_before () {
    $a = new TimeRange( new DateTime( '2022-2-22 22:22' ), new DateTime( '2022-2-22 22:25' ) );
    $b = new TimeRange( new DateTime( '2022-2-22 22:26' ), new DateTime( '2022-2-22 22:27' ) );
    $ret = TimeRangeComparator::isBefore( $a, $b );
    $this->assertTrue( $ret );
  }
  
  public function test_compare_after () {
    $a = new TimeRange( new DateTime( '2022-2-22 22:22' ), new DateTime( '2022-2-22 22:25' ) );
    $b = new TimeRange( new DateTime( '2022-2-22 22:20' ), new DateTime( '2022-2-22 22:21' ) );
    $ret = TimeRangeComparator::isAfter( $a, $b );
    $this->assertTrue( $ret );
  }
  
  public function test_compare_during () {
    $a = new TimeRange( new DateTime( '2022-2-22 22:22' ), new DateTime( '2022-2-22 22:25' ) );
    $b = new TimeRange( new DateTime( '2022-2-22 22:20' ), new DateTime( '2022-2-22 22:26' ) );
    $ret = TimeRangeComparator::isDuring( $a, $b );
    $this->assertTrue( $ret );
  }
  
  public function test_compare_contains () {
    $a = new TimeRange( new DateTime( '2022-2-22 22:20' ), new DateTime( '2022-2-22 22:25' ) );
    $b = new TimeRange( new DateTime( '2022-2-22 22:22' ), new DateTime( '2022-2-22 22:23' ) );
    $ret = TimeRangeComparator::isContains( $a, $b );
    $this->assertTrue( $ret );
  }
  
  public function test_compare_overlapped_before () {
    $a = new TimeRange( new DateTime( '2022-2-22 22:20' ), new DateTime( '2022-2-22 22:25' ) );
    $b = new TimeRange( new DateTime( '2022-2-22 22:24' ), new DateTime( '2022-2-22 22:28' ) );
    $ret = TimeRangeComparator::isOverlappedBefore( $a, $b );
    $this->assertTrue( $ret );
  }
  
  public function test_compare_overlapped_after () {
    $a = new TimeRange( new DateTime( '2022-2-22 22:24' ), new DateTime( '2022-2-22 22:26' ) );
    $b = new TimeRange( new DateTime( '2022-2-22 22:22' ), new DateTime( '2022-2-22 22:25' ) );
    $ret = TimeRangeComparator::isOverlappedAfter( $a, $b );
    $this->assertTrue( $ret );
  }
  
  
}