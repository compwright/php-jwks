<?php

declare(strict_types=1);

namespace Compwright\JWKS;

class KeyFactory
{
    /**
     * @var array<string|Key::TYPE_*>
     */
    private array $supportedTypes = [
        Key::TYPE_RSA,
    ];

    /**
     * @return array<string|Key::TYPE_*>
     */
    public function getSupportedTypes(): array
    {
        return $this->supportedTypes;
    }

    /**
     * @param string|Key::TYPE_* $kty
     */
    public function supportsType(string $kty): bool
    {
        return in_array($kty, $this->supportedTypes);
    }

    /**
     * @param null|string|Key::USE_* $use
     */
    public function createFromPublicKey(string $pem, ?string $use, ?string $kid): Key
    {
        $pkey = \openssl_pkey_get_public($pem);
        if ($pkey === false) {
            throw new \InvalidArgumentException('Error reading public key: ' . \openssl_error_string());
        }

        $keyInfo = \openssl_pkey_get_details($pkey);
        if ($keyInfo === false) {
            throw new \InvalidArgumentException('Error reading public key details: ' . \openssl_error_string());
        }

        switch ($keyInfo['type']) {
            case OPENSSL_KEYTYPE_RSA:
                return new KeyTypes\RsaKey(
                    $use,
                    $kid,
                    Key::ALGORITHM_RS256,
                    Base64Url::encode($keyInfo['rsa']['n']),
                    Base64Url::encode($keyInfo['rsa']['e'])
                );

            default:
                throw new \InvalidArgumentException('Unsupported key type', $keyInfo['type']);
        }
    }

    /**
     * @throws \JsonException
     */
    public function createFromJson(string $json): Key
    {
        /** @var array<string, ?string> $key */
        $key = (array) \json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        return $this->createFromArray($key);
    }

    /**
     * @param array<string, ?string> $key
     *
     * @throws \InvalidArgumentException
     */
    public function createFromArray(array $key): Key
    {
        switch ($key['kty']) {
            case Key::TYPE_RSA:
                return new KeyTypes\RsaKey(
                    $key['use'] ?? null,
                    $key['kid'] ?? null,
                    $key['alg'] ?? null,
                    $key['n'] ?? '',
                    $key['e'] ?? ''
                );

            default:
                throw new \InvalidArgumentException('Unrecognized key type: ' . ($key['kty'] ?? '[missing]'));
        }
    }
}
