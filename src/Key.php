<?php

declare(strict_types=1);

namespace Compwright\JWKS;

/**
 * @property-read string $kty
 */
abstract class Key implements \Stringable
{
    public const TYPE_RSA = 'RSA';
    public const TYPE_OKP = 'OKP';
    public const TYPE_EC = 'EC';

    public const USE_SIGNATURE = 'sig';
    public const USE_ENCRYPTION = 'enc';

    public const ALGORITHM_RS256 = 'RS256';

    /**
     *
     * @param null|string|self::USE_* $use Key use
     * @param null|string $kid Key ID
     * @param null|string|self::ALGORITHM_* $alg Key algorithm
     */
    public function __construct(
        readonly public ?string $use,
        readonly public ?string $kid,
        readonly public ?string $alg
    ) {
    }

    /**
     * @throws \JsonException
     */
    public function __toString(): string
    {
        return \json_encode($this, JSON_THROW_ON_ERROR);
    }

    /**
     * @return array<string, ?string>
     */
    public function toArray(): array
    {
        // @phpstan-ignore-next-line return.type
        return get_object_vars($this);
    }
}
