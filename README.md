# TimeRange Overlapping Checker.

This library for checking Events/Schedule TimeRange have Overlapping.


## Check has overlapping.

## Usage
```php
use Takuya\PhpTimeOverlap\TimeRange;
$a = new TimeRange(new DateTime( '2022-2-22 22:22' ),new DateTime( '2022-2-22 23:22' ));
$b = new TimeRange(new DateTime( '2022-2-22 22:44' ),new DateTime( '2022-2-22 23:44' ));

## check time overlap
$a->has_overlapping($b); // => true
```
other checking way.
```php

$a->before($b);
$a->overlaps($b);
$a->overlapped($b);
$a->during($b);
$a->after($b); 
$a->same($b);
$a->contains($b);
```
## supported patterns


## Installation
from github
```shell
composer config repositories.'php-timerange-overlap' \
         vcs https://github.com/takuya/php-timerange-overlap
composer require takuya/php-timerange-overlap:master
composer install 
```
from packgist
```shell
composer require takuya/php-timerange-overlap
```

## Testing 

```shell
git clone https://github.com/takuya/php-timerange-overlap
cd php-timerange-overlap
composer install 
vendor/bin/phpunit
```