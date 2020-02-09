<?php

namespace Codelayer\VatValidator\Tests;

use Codelayer\VatValidator\VatFormat;
use PHPUnit\Framework\TestCase;

class VatFormatTest extends TestCase
{
    /**
     * @var \Codelayer\VatValidator\VatFormat
     */
    private $vatFormat;

    public function setUp(): void
    {
        $this->vatFormat = new VatFormat();
    }

    public function testItReturnsTrueIfVatNumberIsValid()
    {
        $this->assertTrue($this->vatFormat->isValid('BG 999999999'));
        $this->assertTrue($this->vatFormat->isValid('HR/12345678901'));
        $this->assertTrue($this->vatFormat->isValid('ATU99999999'));
        $this->assertTrue($this->vatFormat->isValid('DE 999 999 999'));
        $this->assertTrue($this->vatFormat->isValid('FRXX999999999'));
        $this->assertTrue($this->vatFormat->isValid('GB-GD001'));
    }

    public function testItReturnsFalseIfVatNumberIsInvalid()
    {
        $this->assertFalse($this->vatFormat->isValid('FO999999999'));
        $this->assertFalse($this->vatFormat->isValid('CZ123'));
        $this->assertFalse($this->vatFormat->isValid('BE200000000'));
        $this->assertFalse($this->vatFormat->isValid('DK999999999'));
        $this->assertFalse($this->vatFormat->isValid('ESXX999999999'));
        $this->assertFalse($this->vatFormat->isValid('FIGD001'));
    }

    public function testItReturnsTheCountryCodeOfAVatNumber()
    {
        $this->assertEquals('DE', $this->vatFormat->country('DE123456'));
        $this->assertEquals('NL', $this->vatFormat->country('NL123456'));
    }

    public function testItReturnsTheNumberPartOfAVatNumber()
    {
        $this->assertEquals('123456', $this->vatFormat->number('DE123456'));
        $this->assertEquals('000000', $this->vatFormat->number('NL000000'));
    }

    public function testItSplitsVatNumbers()
    {
        $this->assertEquals(['DE', '123456'], $this->vatFormat->split('DE123456'));
    }

    public function testItNormalizesVatNumbers()
    {
        $this->assertEquals('DE123456', $this->vatFormat->normalize('DE1-2.3,4/5 6'));
    }
}
