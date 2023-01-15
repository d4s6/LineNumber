<?php

declare(strict_types=1);

/*
 * (c) David Schwarz <mail+oss@davidschwarz.eu>
 * https://davidschwarz.eu
 *
 * License: MIT License
 */

namespace DavidSchwarz\LineNumber;

use LogicException;
use WeakMap;

use function is_object;

/**
 *
 * @author David Schwarz <mail+oss@davidschwarz.eu>
 * @license MIT License
 * @internal
 */
final class InternalService
{
    private static ?self $instance = null;
    /** @var WeakMap<Line, int> */
    private readonly WeakMap $weakMap;

    public static function instance(): self
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct(WeakMap $weakMap = new Weakmap())
    {
        /** @var WeakMap<Line, int> */
        $this->weakMap = $weakMap;
    }

    public function set(Line $line): void
    {
        if ($this->tryGet($line->i)) {
            throw new LogicException('Number already exists');
        }
        $this->weakMap->offsetSet($line, $line->i);
    }

    public function tryGet(int $number): ?Line
    {
        foreach ($this->weakMap as $obj => $id) {
            if ($id === $number) {
                return $obj;
            }
        }
        return null;
    }

    public function add(Line $line, int|Line $number): Line
    {
        if (is_object($number)) {
            $number = $number->i;
        }

        $result = $line->i + $number;

        if ($result < 0) {
            throw new NegativeResultError($line->i, '+', $number, $result);
        }
        return $this->tryGet($result) ?? Line::number($result);
    }

    public function subtract(Line $line, int|Line $number): Line
    {
        if (is_object($number)) {
            $number = $number->i;
        }

        $result = $line->i - $number;

        if ($result < 0) {
            throw new NegativeResultError($line->i, '-', $number, $result);
        }
        return $this->tryGet($result) ?? Line::number($result);
    }
}
