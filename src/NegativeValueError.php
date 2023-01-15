<?php

declare(strict_types=1);

/*
 * (c) David Schwarz <mail+oss@davidschwarz.eu>
 * https://davidschwarz.eu
 *
 * License: MIT License
 */

namespace DavidSchwarz\LineNumber;

use Error;
use Throwable;

use function sprintf;

/**
 *
 * @author David Schwarz <mail+oss@davidschwarz.eu>
 * @license MIT License
 */
class NegativeValueError extends Error
{
    public function __construct(int|Line $number, ?Throwable $previous = null)
    {
        parent::__construct(sprintf('The value "%s" is less than zero.', (string) $number), previous: $previous);
    }
}
