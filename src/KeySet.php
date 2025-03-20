<?php

declare(strict_types=1);

namespace Compwright\JWKS;

/**
 * @implements \IteratorAggregate<Key>
 */
class KeySet implements \Countable, \JsonSerializable, \IteratorAggregate
{
    /**
     * @param Key[] $keys
     */
    public function __construct(protected array $keys = [])
    {
    }

    public function __toString(): string
    {
        return \json_encode($this->jsonSerialize(), JSON_THROW_ON_ERROR);
    }

    public function count(): int
    {
        return \count($this->keys);
    }

    /**
     * @return array{keys:Key[]}
     */
    public function jsonSerialize(): array
    {
        return ['keys' => $this->keys];
    }

    /**
     * @return \ArrayIterator<int, Key>
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->keys);
    }

    public function addKey(Key $key): self
    {
        $this->keys[] = $key;
        return $this;
    }

    public function getById(string $kid): ?Key
    {
        $i = array_search($kid, array_column($this->keys, 'kid'), true);
        return $i === false ? null : $this->keys[$i];
    }
}
