# Line number

Line numbers as _immutable_ value objects.  
With a [WeakMap](https://www.php.net/WeakMap) based repository in the background.

## installation

```bash
composer require davidschwarz/line-number
```

## example

```php
require __DIR__ . '/vendor/autoload.php';

use DavidSchwarz\LineNumber\Line;

$startLine = Line::number(0);
$otherLine = $startLine->add(2);

$otherLine->equals($startLine); // FALSE
$otherLine->equals(2);          // TRUE

(string) Line::number(7);       // '7'
Line::number(7)->i;             // 7

Line::number(-1);               // throws ...\NegativeValueError

Line::number(0)->subtract(2);   // throws ...\NegativeResultError

```

## license
[MIT License](LICENSE.txt)

## author
[David Schwarz / Ringsdorf](https://davidschwarz.eu/)
