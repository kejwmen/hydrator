<?php

declare(strict_types=1);

namespace kejwmen\Hydrator;

use function end;
use function Functional\select_keys;
use function key;

final class ArrayHydrator implements Hydrator
{
    /** @var ArrayHydratorMapping */
    private $mapping;

    /** @var mixed[] */
    private $result;

    /** @var string[] */
    private $keyTracker;

    public function __construct(ArrayHydratorMapping $mapping)
    {
        $this->mapping    = $mapping;
        $this->result     = [];
        $this->keyTracker = [];
    }

    /**
     * @param mixed[] $data
     *
     * @return mixed[]
     */
    public function hydrate(array $data) : array
    {
        $this->result     = [];
        $this->keyTracker = [];

        foreach ($data as $row) {
            $row = select_keys($row, $this->mapping->allFields());

            $rootIdentifier = (string) $row[$this->mapping->rootIndex()];

            $rootPath = '_' . $rootIdentifier;

            if ($this->hasResultKey($rootPath)) {
                $resultKey = $this->resultKey($rootPath);

                $this->result[$resultKey] = $this->hydrateCollection(
                    $row,
                    $this->mapping->rootChildren(),
                    $this->result[$resultKey],
                    $rootPath
                );
            } else {
                $this->result[] = $this->hydrateCollection(
                    $row,
                    $this->mapping->rootChildren(),
                    select_keys($row, $this->mapping->rootFields()),
                    $rootPath
                );

                $this->trackAddedResultKey($rootPath, $this->result);
            }
        }

        return $this->result;
    }

    /**
     * @param mixed[]  $inputRow
     * @param string[] $aliases
     * @param mixed[]  $currentResultRow
     *
     * @return mixed[]
     */
    private function hydrateCollection(
        array $inputRow,
        array $aliases,
        array $currentResultRow,
        string $parentPath
    ) : array {
        foreach ($aliases as $alias) {
            $identifier = (string) $inputRow[$this->mapping->index($alias)];

            $path = $parentPath . '_' . $alias . '_' . $identifier;

            if ($this->hasResultKey($path)) {
                $key                            = $this->resultKey($path);
                $currentResultRow[$alias][$key] = $this->hydrateCollection(
                    $inputRow,
                    $this->mapping->children($alias),
                    $currentResultRow[$alias][$key],
                    $path
                );
            } else {
                $currentResultRow[$alias][] = $this->hydrateCollection(
                    $inputRow,
                    $this->mapping->children($alias),
                    select_keys($inputRow, $this->mapping->fields($alias)),
                    $path
                );

                $this->trackAddedResultKey($path, $currentResultRow[$alias]);
            }
        }

        return $currentResultRow;
    }

    /**
     * @param mixed[] $results
     */
    private function trackAddedResultKey(string $path, array $results) : void
    {
        end($results);
        $this->keyTracker[$path] = (string) key($results);
    }

    private function resultKey(string $path) : ?string
    {
        return $this->keyTracker[$path] ?? null;
    }

    private function hasResultKey(string $path) : bool
    {
        return $this->resultKey($path) !== null;
    }
}
