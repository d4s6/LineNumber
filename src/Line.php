<?php

declare(strict_types=1);

/*
 * (c) David Schwarz <mail+oss@davidschwarz.eu>
 * https://davidschwarz.eu
 *
 * License: MIT License
 */

namespace DavidSchwarz\LineNumber;

use DavidSchwarz\LineNumber\InternalService as Service;
use Stringable;

/**
 *
 * @author David Schwarz <mail+oss@davidschwarz.eu>
 * @license MIT License
 */
final readonly class Line implements Stringable
{
    public static function number(int $number): self
    {
        if ($number < 0) {
            throw new NegativeValueError($number);
        }

        $numberObject = Service::instance()->tryGet($number);
        if (null !== $numberObject) {
            return $numberObject;
        }
        $numberObject = new self($number);
        Service::instance()->set($numberObject);
        return $numberObject;
    }

    private function __construct(public int $i)
    {
    }

    public function equals(self|int $number): bool
    {
        if (is_object($number)) {
            $number = $number->i;
        }
        return ($this->i === $number);
    }

    public function __toString(): string
    {
        return (string) $this->i;
    }

    public function add(self|int $number): Line
    {
        return Service::instance()->add($this, $number);
    }

    public function subtract(self|int $number): Line
    {
        return Service::instance()->subtract($this, $number);
    }
}
