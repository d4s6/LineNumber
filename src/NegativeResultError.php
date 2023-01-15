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
class NegativeResultError extends Error
{
    public function __construct(int $a, string $operator, int $b, int $result, ?Throwable $previous = null)
    {
        $computation = ''.$a.$operator.$b;
        parent::__construct(sprintf('The result "%s of "%s" is less than zero.', $result, $computation), previous: $previous);
    }
}
