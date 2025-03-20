<?php

declare(strict_types=1);

namespace Compwright\JWKS;

class KeySetFactory
{
    public function __construct(private KeyFactory $keyFactory)
    {
    }

    /**
     * @throws \JsonException
     */
    public function createFromJson(string $json): KeySet
    {
        $data = (array) \json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        /** @var array<array<string, ?string>> $keys */
        $keys = $data['keys'] ?? [];
        return $this->createFromArray($keys);
    }

    /**
     * @param array<array<string, ?string>> $keys
     */
    public function createFromArray(array $keys): KeySet
    {
        $set = new KeySet();

        foreach ($keys as $key) {
            try {
                $set->addKey(
                    $this->keyFactory->createFromArray($key)
                );
            } catch (\InvalidArgumentException $e) {
                // skip unsupported key types
            }
        }

        return $set;
    }
}
