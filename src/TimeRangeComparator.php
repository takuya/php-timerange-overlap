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
    } else {
      throw new \Exception( 'Unknown error. start/end has equal?.' );
    }
  }
  
}