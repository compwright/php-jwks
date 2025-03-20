<?php

declare(strict_types=1);

namespace Compwright\JWKS\KeyTypes;

use Compwright\JWKS\Base64Url;
use Compwright\JWKS\Key;
use phpseclib3\Crypt\PublicKeyLoader;
use phpseclib3\Math\BigInteger;

class RsaKey extends Key
{
    /**
     * @var string|self::TYPE_* Key type
     */
    public readonly string $kty;

    /**
     * @inheritdoc
     * @param string $n RSA modulus
     * @param string $e RSA public exponent
     */
    public function __construct(
        readonly public ?string $use,
        readonly public ?string $kid,
        readonly public ?string $alg,
        readonly public string $n,
        readonly public string $e
    ) {
        $this->kty = Key::TYPE_RSA;
    }

    public function getPem(): string
    {
        $modulus = Base64Url::decode($this->n, true);
        return (string) PublicKeyLoader::load([
            'e' => new BigInteger(\base64_decode($this->e, true) ?: '', 256),
            'n' => new BigInteger($modulus, 256),
        ]);
    }
}
