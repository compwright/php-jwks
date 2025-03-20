<?php

declare(strict_types=1);

namespace Compwright\JWKS;

use PHPUnit\Framework\TestCase;

class KeyFactoryTest extends TestCase
{
    public function testCreateFromPem(): void
    {
        $factory = new KeyFactory();

        $pem = file_get_contents(__DIR__ . '/key.pem') ?: '';
        $json = file_get_contents(__DIR__ . '/key.json') ?: '';

        /** @var KeyTypes\RsaKey $key */
        $key = $factory->createFromPublicKey($pem, Key::USE_SIGNATURE, 'eXaunmL');

        $this->assertInstanceOf(KeyTypes\RsaKey::class, $key);
        $this->assertEquals(Key::ALGORITHM_RS256, $key->alg);
        $this->assertEquals(Key::USE_SIGNATURE, $key->use);
        $this->assertEquals('eXaunmL', $key->kid);
        $this->assertEquals('4dGQ7bQK8LgILOdLsYzfZjkEAoQeVC_aqyc8GC6RX7dq_KvRAQAWPvkam8VQv4GK5T4ogklEKEvj5ISBamdDNq1n52TpxQwI2EqxSk7I9fKPKhRt4F8-2yETlYvye-2s6NeWJim0KBtOVrk0gWvEDgd6WOqJl_yt5WBISvILNyVg1qAAM8JeX6dRPosahRVDjA52G2X-Tip84wqwyRpUlq2ybzcLh3zyhCitBOebiRWDQfG26EH9lTlJhll-p_Dg8vAXxJLIJ4SNLcqgFeZe4OfHLgdzMvxXZJnPp_VgmkcpUdRotazKZumj6dBPcXI_XID4Z4Z3OM1KrZPJNdUhxw', $key->n);
        $this->assertEquals('AQAB', $key->e);
        $this->assertEquals($pem, $key->getPem());
        $this->assertSame($json, (string) $key);
    }

    public function testCreateFromJson(): void
    {
        $factory = new KeyFactory();

        $pem = file_get_contents(__DIR__ . '/key.pem') ?: '';
        $json = file_get_contents(__DIR__ . '/key.json') ?: '';

        /** @var KeyTypes\RsaKey $key */
        $key = $factory->createFromJson($json);

        $this->assertInstanceOf(KeyTypes\RsaKey::class, $key);
        $this->assertEquals(Key::ALGORITHM_RS256, $key->alg);
        $this->assertEquals(Key::USE_SIGNATURE, $key->use);
        $this->assertEquals('eXaunmL', $key->kid);
        $this->assertEquals('4dGQ7bQK8LgILOdLsYzfZjkEAoQeVC_aqyc8GC6RX7dq_KvRAQAWPvkam8VQv4GK5T4ogklEKEvj5ISBamdDNq1n52TpxQwI2EqxSk7I9fKPKhRt4F8-2yETlYvye-2s6NeWJim0KBtOVrk0gWvEDgd6WOqJl_yt5WBISvILNyVg1qAAM8JeX6dRPosahRVDjA52G2X-Tip84wqwyRpUlq2ybzcLh3zyhCitBOebiRWDQfG26EH9lTlJhll-p_Dg8vAXxJLIJ4SNLcqgFeZe4OfHLgdzMvxXZJnPp_VgmkcpUdRotazKZumj6dBPcXI_XID4Z4Z3OM1KrZPJNdUhxw', $key->n);
        $this->assertEquals('AQAB', $key->e);
        $this->assertEquals($pem, $key->getPem());
        $this->assertSame($json, (string) $key);
    }
}
