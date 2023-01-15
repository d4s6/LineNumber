<?php

declare(strict_types=1);

/*
 * (c) David Schwarz <mail+oss@davidschwarz.eu>
 * https://davidschwarz.eu
 *
 * License: MIT License
 */

namespace DavidSchwarz\LineNumber;

use PHPUnit\Framework\TestCase;

/**
 *
 * @author David Schwarz <mail+oss@davidschwarz.eu>
 * @license MIT License
 * @psalm-suppress MissingConstructor
 */
final class LineTest extends TestCase
{
    public function testStaticConstructor(): void
    {
        $this->assertInstanceOf(Line::class, Line::number(0));
    }

    public function testNotInstanciateWithNew(): void
    {
        $this->expectError();
        /** @psalm-suppress InaccessibleMethod */
        new Line(0);
    }

    public function testErrorOnNegativeValue(): void
    {
        $this->expectException(NegativeValueError::class);
        Line::number(-1);
    }

    public function testAccessibleIProperty(): void
    {
        $this->assertIsInt(Line::number(0)->i);
    }

    public function testToString(): void
    {
        $this->assertSame('0', (string) Line::number(0));
    }

    public function testEquals(): void
    {
        $number0 = Line::number(0);
        $this->assertTrue($number0->equals($number0));
        $this->assertTrue($number0->equals(0));

        $number1 = Line::number(1);
        $this->assertFalse($number0->equals($number1));
        $this->assertFalse($number0->equals(1));
    }

    public function testAdd(): void
    {
        $this->assertSame(7, Line::number(5)->add(2)->i);
        $this->assertSame(3, Line::number(5)->add(-2)->i);
    }

    public function testErrorOnNegativeSum(): void
    {
        $this->expectException(NegativeResultError::class);
        Line::number(1)->add(-2);
    }

    public function testSubtract(): void
    {
        $this->assertSame(7, Line::number(9)->subtract(2)->i);
        $this->assertSame(7, Line::number(5)->subtract(-2)->i);
    }

    public function testErrorOnNegativeDifference(): void
    {
        $this->expectException(NegativeResultError::class);
        Line::number(1)->subtract(2);
    }
}
