# TimeRange Overlapping Checker.
![](https://github.com/takuya/php-timerange-overlap/workflows/main/badge.svg)


This library for checking Events/Schedule TimeRange have Overlapping.


## Check has overlapping.

## Usage
```php
use Takuya\PhpTimeOverlap\TimeRange;
$a = new TimeRange(new DateTime( '22:22' ),new DateTime( '23:22' ));
$b = new TimeRange(new DateTime( '22:44' ),new DateTime( '23:44' ));

## check time overlap
$a->has_overlapping($b); // => true
```
Other checking like this.
```php

$a->before($b);
$a->overlapped($b);
$a->during($b);
$a->overlaps($b);
$a->after($b); 
$a->contains($b);
$a->same($b);
```
## Supported patterns.
I named overlapping patterns like this.

<img src='https://github.com/takuya/php-timerange-overlap/raw/master/docs/images/names.png' maxwidth='500' />

EQUALS(start==end) pattern excluded intentionally. If equal ex.`A->end == B->start` compared,It will be overlapping.
Comparing equals `22:22-22:25` to `22:25-22:27` , do minus explicitly(` -1 sec`  before comparing). 



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
