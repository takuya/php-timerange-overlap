<?php

namespace Takuya\PhpTimeOverlap;

class TimeRange {
  
  /**
   * @var \DateTimeInterface
   */
  public $start;
  /**
   * @var \DateTimeInterface
   */
  public $end;
  
  /**
   * @param \DateTimeInterface $start
   * @param \DateTimeInterface $end
   */
  public function __construct ( \DateTimeInterface $start, \DateTimeInterface $end ) {
    if ( $start >= $end ) {
      throw new \InvalidArgumentException( 'Arguments shout be $start < $end' );
    }
    [$this->start, $this->end] = [$start, $end];
  }
  
  /**
   * @param TimeRange $b
   * @return bool
   */
  public function overlaps ( TimeRange $b ) {
    return TimeRangeComparator::isOverlappedBefore( $this, $b );
  }
  
  /**
   * @param TimeRange $b
   * @return bool
   */
  public function overlapped ( TimeRange $b ) {
    return TimeRangeComparator::isOverlappedAfter( $this, $b );
  }
  
  /**
   * @param TimeRange $b
   * @return bool
   */
  public function before ( TimeRange $b ) {
    return TimeRangeComparator::isBefore( $this, $b );
  }
  
  /**
   * @param TimeRange $b
   * @return bool
   */
  public function after ( TimeRange $b ) {
    return TimeRangeComparator::isAfter( $this, $b );
  }
  
  /**
   * @param TimeRange $b
   * @return bool
   */
  public function same ( TimeRange $b ) {
    return TimeRangeComparator::isSame( $this, $b );
  }
  
  /**
   * @param TimeRange $b
   * @return bool
   */
  public function contains ( TimeRange $b ) {
    return TimeRangeComparator::isContains( $this, $b );
  }
  
  /**
   * @param TimeRange $b
   * @return bool
   */
  public function during ( TimeRange $b ) {
    return TimeRangeComparator::isDuring( $this, $b );
  }
  
  /**
   * @param $b
   * @return bool
   * @throws \Exception
   */
  public function has_overlapping ( $b ) {
    $ret = TimeRangeComparator::compare( $this, $b );
    return TimeRangeComparator::OVERLAPPING == ( $ret & TimeRangeComparator::OVERLAPPING );
  }
  
  
}