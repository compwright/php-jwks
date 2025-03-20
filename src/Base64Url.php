<?php

declare(strict_types=1);

namespace Compwright\JWKS;

class Base64Url
{
    public static function decode(string $data, bool $strict = false): string
    {
        $b64 = \strtr($data, '-_', '+/');
        return \base64_decode($b64, $strict) ?: '';
    }

    public static function encode(string $data): string
    {
        return \rtrim(\strtr(\base64_encode($data), '+/', '-_'), '=');
    }
}
