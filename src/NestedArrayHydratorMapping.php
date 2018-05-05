<?php

declare(strict_types=1);

namespace kejwmen\Hydrator;

use function Functional\first;
use function Functional\flat_map;

final class NestedArrayHydratorMapping implements ArrayHydratorMapping
{
    /** @var mixed[] */
    private $aliases = [];

    /**
     * @param mixed[] $aliases
     */
    public function __construct(array $aliases)
    {
        $this->aliases = $aliases;
    }

    /**
     * @return string[]
     */
    public function fields(string $alias) : array
    {
        return $this->aliases[$alias]['fields'];
    }

    /**
     * @return string[]
     */
    public function allFields() : array
    {
        return flat_map($this->aliases, function (array $alias) {
            return $alias['fields'];
        });
    }

    /**
     * @return string[]
     */
    public function rootFields() : array
    {
        return $this->root()['fields'];
    }

    public function index(string $alias) : string
    {
        return $this->aliases[$alias]['index'];
    }

    /**
     * @return string[]
     */
    public function children(string $alias) : array
    {
        return $this->aliases[$alias]['children'];
    }

    /**
     * @return string[]
     */
    public function rootChildren() : array
    {
        return $this->root()['children'];
    }

    public function rootIndex() : string
    {
        return $this->root()['index'];
    }

    /**
     * @return mixed[]
     */
    private function root() : array
    {
        return first($this->aliases, function (array $alias) {
            return $alias['parent'] === null;
        });
    }
}
