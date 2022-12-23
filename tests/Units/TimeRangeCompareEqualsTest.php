<?php

namespace Tests\PhpTimeOverlap\Units;

use Tests\PhpTimeOverlap\TestCase;
use Takuya\PhpTimeOverlap\TimeRange;
use Takuya\PhpTimeOverlap\TimeRangeComparator;
use DateTime;

class TimeRangeCompareEqualsTest extends TestCase {
  
  public function test_a_start_b_start_at_same_time () {
    $a = new TimeRange( new DateTime( '2022-2-22' ), new DateTime( '2022-2-23' ) );
    $b = new TimeRange( new DateTime( '2022-2-22' ), new DateTime( '2022-2-24' ) );
    //
    $this->assertEquals( false, TimeRangeComparator::isBefore( $a, $b ) );
    $this->assertEquals( false, TimeRangeComparator::isOverlappedBefore( $a, $b ) );
    $this->assertEquals( false, TimeRangeComparator::isDuring( $a, $b ) );
    $this->assertEquals( false, TimeRangeComparator::isContains( $a, $b ) );
    $this->assertEquals( false, TimeRangeComparator::isSame( $a, $b ) );
    $this->assertEquals( false, TimeRangeComparator::isOverlappedAfter( $a, $b ) );
    $this->assertEquals( false, TimeRangeComparator::isAfter( $a, $b ) );
    $this->assertEquals( true, TimeRangeComparator::isStartAtOnce( $a, $b ) );
    $this->assertEquals( false, TimeRangeComparator::isEndFollowed( $a, $b ) );
    $this->assertEquals( false, TimeRangeComparator::isEndTogether( $a, $b ) );
    $this->assertEquals( false, TimeRangeComparator::isFollowingStart( $a, $b ) );
    //
    $this->assertEquals( TimeRangeComparator::START_AT_ONCE, TimeRangeComparator::compare( $a, $b ) );
    $this->assertTrue( $a->has_overlapping( $b ) );
  }
  
  public function test_a_end_b_start_no_gap_in_end () {
    $a = new TimeRange( new DateTime( '2022-2-22' ), new DateTime( '2022-2-23' ) );
    $b = new TimeRange( new DateTime( '2022-2-23' ), new DateTime( '2022-2-24' ) );
    //
    $this->assertEquals( false, TimeRangeComparator::isBefore( $a, $b ) );
    $this->assertEquals( false, TimeRangeComparator::isOverlappedBefore( $a, $b ) );
    $this->assertEquals( false, TimeRangeComparator::isDuring( $a, $b ) );
    $this->assertEquals( false, TimeRangeComparator::isContains( $a, $b ) );
    $this->assertEquals( false, TimeRangeComparator::isSame( $a, $b ) );
    $this->assertEquals( false, TimeRangeComparator::isOverlappedAfter( $a, $b ) );
    $this->assertEquals( false, TimeRangeComparator::isAfter( $a, $b ) );
    $this->assertEquals( false, TimeRangeComparator::isStartAtOnce( $a, $b ) );
    $this->assertEquals( true, TimeRangeComparator::isEndFollowed( $a, $b ) );
    $this->assertEquals( false, TimeRangeComparator::isEndTogether( $a, $b ) );
    $this->assertEquals( false, TimeRangeComparator::isFollowingStart( $a, $b ) );
    //
    $this->assertEquals( TimeRangeComparator::END_FOLLOWED, TimeRangeComparator::compare( $a, $b ) );
    $this->assertTrue( $a->has_overlapping( $b ) );
  }
  
  public function test_a_end_b_end_together () {
    $a = new TimeRange( new DateTime( '2022-2-20' ), new DateTime( '2022-2-23' ) );
    $b = new TimeRange( new DateTime( '2022-2-22' ), new DateTime( '2022-2-23' ) );
    //
    $this->assertEquals( false, TimeRangeComparator::isBefore( $a, $b ) );
    $this->assertEquals( false, TimeRangeComparator::isOverlappedBefore( $a, $b ) );
    $this->assertEquals( false, TimeRangeComparator::isDuring( $a, $b ) );
    $this->assertEquals( false, TimeRangeComparator::isContains( $a, $b ) );
    $this->assertEquals( false, TimeRangeComparator::isSame( $a, $b ) );
    $this->assertEquals( false, TimeRangeComparator::isOverlappedAfter( $a, $b ) );
    $this->assertEquals( false, TimeRangeComparator::isAfter( $a, $b ) );
    $this->assertEquals( false, TimeRangeComparator::isStartAtOnce( $a, $b ) );
    $this->assertEquals( false, TimeRangeComparator::isEndFollowed( $a, $b ) );
    $this->assertEquals( true, TimeRangeComparator::isEndTogether( $a, $b ) );
    $this->assertEquals( false, TimeRangeComparator::isFollowingStart( $a, $b ) );
    //
    $this->assertEquals( TimeRangeComparator::END_TOGETHER, TimeRangeComparator::compare( $a, $b ) );
    $this->assertTrue( $a->has_overlapping( $b ) );
  }
  
  public function test_a_following_start_at_b_end () {
    $a = new TimeRange( new DateTime( '2022-2-22' ), new DateTime( '2022-2-23' ) );
    $b = new TimeRange( new DateTime( '2022-2-21' ), new DateTime( '2022-2-22' ) );
    //
    $this->assertEquals( false, TimeRangeComparator::isBefore( $a, $b ) );
    $this->assertEquals( false, TimeRangeComparator::isOverlappedBefore( $a, $b ) );
    $this->assertEquals( false, TimeRangeComparator::isDuring( $a, $b ) );
    $this->assertEquals( false, TimeRangeComparator::isContains( $a, $b ) );
    $this->assertEquals( false, TimeRangeComparator::isSame( $a, $b ) );
    $this->assertEquals( false, TimeRangeComparator::isOverlappedAfter( $a, $b ) );
    $this->assertEquals( false, TimeRangeComparator::isAfter( $a, $b ) );
    $this->assertEquals( false, TimeRangeComparator::isStartAtOnce( $a, $b ) );
    $this->assertEquals( false, TimeRangeComparator::isEndFollowed( $a, $b ) );
    $this->assertEquals( false, TimeRangeComparator::isEndTogether( $a, $b ) );
    $this->assertEquals( true, TimeRangeComparator::isFollowingStart( $a, $b ) );
    //
    $this->assertEquals( TimeRangeComparator::FOLLOWING_START, TimeRangeComparator::compare( $a, $b ) );
    $this->assertTrue( $a->has_overlapping( $b ) );
  }
}