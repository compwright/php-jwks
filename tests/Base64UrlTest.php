<?php

declare(strict_types=1);

namespace Compwright\JWKS;

use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class Base64UrlTest extends TestCase
{
    /**
     * @dataProvider provideDecode
     */
    public function testDecode(string $expected, string $input): void
    {
        $this->assertSame($expected, Base64Url::decode($input));
    }

    public static function provideDecode(): \Generator
    {
        yield [
            'expected' => '/a+quick+brown+fox/jumped-over/the_lazy_dog/',
            'input' => 'L2ErcXVpY2srYnJvd24rZm94L2p1bXBlZC1vdmVyL3RoZV9sYXp5X2RvZy8',
        ];
    }

    /**
     * @dataProvider provideEncode
     */
    public function testEncode(string $expected, string $input): void
    {
        static::assertSame($expected, Base64Url::encode($input));
    }

    public static function provideEncode(): \Generator
    {
        yield [
            'expected' => 'L2ErcXVpY2srYnJvd24rZm94L2p1bXBlZC1vdmVyL3RoZV9sYXp5X2RvZy8',
            'input' => '/a+quick+brown+fox/jumped-over/the_lazy_dog/',
        ];
    }
}
