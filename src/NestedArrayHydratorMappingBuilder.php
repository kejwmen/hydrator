<?php

declare(strict_types=1);

namespace kejwmen\Hydrator;

use function Functional\first;

final class NestedArrayHydratorMappingBuilder
{
    /** @var mixed[] */
    private $aliases = [];

    /** @var string */
    private $rootIndex;

    /** @var string[] */
    private $indexes = [];

    public function __construct(string $rootIndex)
    {
        $this->rootIndex = $rootIndex;
    }

    /**
     * @param mixed[] $fields
     */
    public function addRootCollection(array $fields, string $alias) : self
    {
        $this->aliases[$alias] = [
            'index' => $this->rootIndex,
            'parent' => null,
            'children' => [],
            'fields' => $fields,
        ];

        $this->registerIndex($alias, $this->rootIndex);

        return $this;
    }

    /**
     * @param mixed[] $fields
     */
    public function addCollection(string $fromAlias, array $fields, string $alias, ?string $indexField = null) : self
    {
        $this->registerIndex($alias, $indexField ?? first($fields));

        $this->aliases[$alias] = [
            'index' => $this->indexes[$alias],
            'parent' => $fromAlias,
            'children' => [],
            'fields' => $fields,
        ];

        $this->aliases[$fromAlias]['children'][] = $alias;

        return $this;
    }

    public function build() : ArrayHydratorMapping
    {
        return new NestedArrayHydratorMapping($this->aliases);
    }

    private function registerIndex(string $alias, string $indexField) : self
    {
        $this->indexes[$alias] = $indexField;

        return $this;
    }
}
