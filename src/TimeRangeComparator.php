<?php

namespace Takuya\PhpTimeOverlap;

class TimeRangeComparator {
  const OVERLAPPING = 0x001;
  const OVERLAPPED = 0x003;
  const OVERLAPS = 0x005;
  const SAME = 0x007;
  const CONTAINS = 0x009;
  const DURING = 0x011;
  const AFTER = 0x002;
  const BEFORE = 0x004;
  const START_AT_ONCE = 0x0013;
  const END_TOGETHER   = 0x0015;
  const END_FOLLOWED = 0x00017;
  const FOLLOWING_START = 0x00019;
  
  /**
   * @param TimeRange $a
   * @param TimeRange $b
   * @return bool
   */
  public static function isBefore ( TimeRange $a, TimeRange $b ) {
    return $a->end < $b->start;
  }
  
  /**
   * @param TimeRange $a
   * @param TimeRange $b
   * @return bool
   */
  public static function isAfter ( TimeRange $a, TimeRange $b ) {
    return $b->end < $a->start;
  }
  
  /**
   * @param TimeRange $a
   * @param TimeRange $b
   * @return bool
   */
  public static function isSame ( TimeRange $a, TimeRange $b ) {
    return $a->start == $b->start && $a->end == $b->end;
  }
  
  /**
   * @param TimeRange $a
   * @param TimeRange $b
   * @return bool
   */
  public static function isStartAtOnce( TimeRange $a, TimeRange $b){
    return $a->start== $b->start;
  }
  
  /**
   * @param TimeRange $a
   * @param TimeRange $b
   * @return bool
   */
  public static function isEndTogether( TimeRange $a, TimeRange $b){
    return $a->end== $b->end;
  }
  
  /**
   * @param TimeRange $a
   * @param TimeRange $b
   * @return bool
   */
  public static function isEndFollowed( TimeRange $a, TimeRange $b){
    return $a->end == $b->start;
  }
  
  /**
   * @param TimeRange $a
   * @param TimeRange $b
   * @return bool
   */
  public static function isFollowingStart( TimeRange $a, TimeRange $b){
    return $b->end==$a->start;
  }
  
  /**
   * @param TimeRange $a
   * @param TimeRange $b
   * @return bool
   */
  public static function isDuring ( TimeRange $a, TimeRange $b ) {
    return $b->start < $a->start && $a->end < $b->end;
  }
  
  /**
   * @param TimeRange $a
   * @param TimeRange $b
   * @return bool
   */
  public static function isContains ( TimeRange $a, TimeRange $b ) {
    return $a->start < $b->start && $b->end < $a->end;
  }
  
  /**
   * @param TimeRange $a
   * @param TimeRange $b
   * @return bool
   */
  public static function isOverlappedBefore ( TimeRange $a, TimeRange $b ) {
    return $a->start < $b->start && $b->start < $a->end && $a->end < $b->end;
  }
  
  /**
   * @param TimeRange $a
   * @param TimeRange $b
   * @return bool
   */
  public static function isOverlappedAfter ( TimeRange $a, TimeRange $b ) {
    return $a->start < $b->end
      && $b->end < $a->end
      && $b->start < $a->start;
  }
  
  /**
   * @param TimeRange $a
   * @param TimeRange $b
   * @return int
   * @throws \Exception
   */
  public static function compare ( TimeRange $a, TimeRange $b ) {
    if ( self::isSame( $a, $b ) ) {
      return self::SAME;
    } else if ( self::isBefore( $a, $b ) ) {
      return self::BEFORE;
    } else if ( self::isAfter( $a, $b ) ) {
      return self::AFTER;
    } else if ( self::isOverlappedBefore( $a, $b ) ) {
      return self::OVERLAPPED;
    } else if ( self::isContains( $a, $b ) ) {
      return self::CONTAINS;
    } else if ( self::isDuring( $a, $b ) ) {
      return self::DURING;
    } else if ( self::isOverlappedAfter( $a, $b ) ) {
      return self::OVERLAPS;
    } else if ( self::isStartAtOnce( $a, $b ) ) {
      return self::START_AT_ONCE;
    } else if ( self::isEndTogether( $a, $b ) ) {
      return self::END_TOGETHER;
    } else if ( self::isEndFollowed( $a, $b ) ) {
      return self::END_FOLLOWED;
    } else if ( self::isFollowingStart( $a, $b ) ) {
      return self::FOLLOWING_START;
    } else {
      return -1;
      //throw new \Exception( 'Unknown error. not supported pattern.' );
    }
  }
  
}