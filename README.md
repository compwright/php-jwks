# php-jwk

[![Latest Stable Version](https://poser.pugx.org/compwright/php-jwks/v/stable)](https://packagist.org/packages/compwright/php-jwks)
![coverage](https://raw.githubusercontent.com/Strobotti/php-jwk/gh-pages/.badges/master/coverage.svg)
[![License](https://poser.pugx.org/compwright/php-jwks/license)](https://packagist.org/packages/compwright/php-jwks)

JSON Web Key tools for PHP per [RFC-7517](https://tools.ietf.org/html/rfc7517)

Inspired by https://github.com/Strobotti/php-jwk, but reimagined, simplified, and updated for PHP 8.4.

## Installation

```bash
$ composer require compwright/php-jwks
```

## Example usage

### Create a key-object from PEM

```php
<?php

$pem = <<<PEM
-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA4dGQ7bQK8LgILOdLsYzf
ZjkEAoQeVC/aqyc8GC6RX7dq/KvRAQAWPvkam8VQv4GK5T4ogklEKEvj5ISBamdD
Nq1n52TpxQwI2EqxSk7I9fKPKhRt4F8+2yETlYvye+2s6NeWJim0KBtOVrk0gWvE
Dgd6WOqJl/yt5WBISvILNyVg1qAAM8JeX6dRPosahRVDjA52G2X+Tip84wqwyRpU
lq2ybzcLh3zyhCitBOebiRWDQfG26EH9lTlJhll+p/Dg8vAXxJLIJ4SNLcqgFeZe
4OfHLgdzMvxXZJnPp/VgmkcpUdRotazKZumj6dBPcXI/XID4Z4Z3OM1KrZPJNdUh
xwIDAQAB
-----END PUBLIC KEY-----
PEM;

$keyFactory = new Compwright\JWKS\KeyFactory();
$key = $keyFactory->createFromPem($pem, Key::USE_SIGNATURE, 'eXaunmL');

echo (string) $key;
```

Outputs:

```json
{
    "kty": "RSA",
    "use": "sig",
    "alg": "RS256",
    "kid": "eXaunmL",
    "n": "4dGQ7bQK8LgILOdLsYzfZjkEAoQeVC_aqyc8GC6RX7dq_KvRAQAWPvkam8VQv4GK5T4ogklEKEvj5ISBamdDNq1n52TpxQwI2EqxSk7I9fKPKhRt4F8-2yETlYvye-2s6NeWJim0KBtOVrk0gWvEDgd6WOqJl_yt5WBISvILNyVg1qAAM8JeX6dRPosahRVDjA52G2X-Tip84wqwyRpUlq2ybzcLh3zyhCitBOebiRWDQfG26EH9lTlJhll-p_Dg8vAXxJLIJ4SNLcqgFeZe4OfHLgdzMvxXZJnPp_VgmkcpUdRotazKZumj6dBPcXI_XID4Z4Z3OM1KrZPJNdUhxw",
    "e": "AQAB"
}
```

### Create a JWK Set (JWKS) from a key

```php
<?php
// ...pick up from the previous example
$keySet = new \Compwright\JWKS\KeySet();
$keySet->addKey($key);

echo (string) $keySet;
```

Outputs:

```json
{
    "keys": [
        {
            "kty": "RSA",
            "use": "sig",
            "alg": "RS256",
            "kid": "eXaunmL",
            "n": "4dGQ7bQK8LgILOdLsYzfZjkEAoQeVC_aqyc8GC6RX7dq_KvRAQAWPvkam8VQv4GK5T4ogklEKEvj5ISBamdDNq1n52TpxQwI2EqxSk7I9fKPKhRt4F8-2yETlYvye-2s6NeWJim0KBtOVrk0gWvEDgd6WOqJl_yt5WBISvILNyVg1qAAM8JeX6dRPosahRVDjA52G2X-Tip84wqwyRpUlq2ybzcLh3zyhCitBOebiRWDQfG26EH9lTlJhll-p_Dg8vAXxJLIJ4SNLcqgFeZe4OfHLgdzMvxXZJnPp_VgmkcpUdRotazKZumj6dBPcXI_XID4Z4Z3OM1KrZPJNdUhxw",
            "e": "AQAB"
        }
    ]
}
```

### Get a key from a keyset by `kid` and convert it to PEM

```php
<?php
// ...pick up from the previous example

$key = $keySet->getById('eXaunmL');
$pem = $key->getPem();

echo $pem;
```

Outputs:

```text
-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA4dGQ7bQK8LgILOdLsYzf
ZjkEAoQeVC/aqyc8GC6RX7dq/KvRAQAWPvkam8VQv4GK5T4ogklEKEvj5ISBamdD
Nq1n52TpxQwI2EqxSk7I9fKPKhRt4F8+2yETlYvye+2s6NeWJim0KBtOVrk0gWvE
Dgd6WOqJl/yt5WBISvILNyVg1qAAM8JeX6dRPosahRVDjA52G2X+Tip84wqwyRpU
lq2ybzcLh3zyhCitBOebiRWDQfG26EH9lTlJhll+p/Dg8vAXxJLIJ4SNLcqgFeZe
4OfHLgdzMvxXZJnPp/VgmkcpUdRotazKZumj6dBPcXI/XID4Z4Z3OM1KrZPJNdUh
xwIDAQAB
-----END PUBLIC KEY-----
```

## Contributing

See [CONTRIBUTING.md](CONTRIBUTING.md) for more details.

## License

MIT License
