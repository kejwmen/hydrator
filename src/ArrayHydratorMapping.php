<?php

declare(strict_types=1);

namespace kejwmen\Hydrator;

interface ArrayHydratorMapping
{
    /**
     * @return string[]
     */
    public function fields(string $alias) : array;
    /**
     * @return string[]
     */
    public function rootFields() : array;
    /**
     * @return string[]
     */
    public function allFields() : array;
    /**
     * @return string[]
     */
    public function children(string $alias) : array;
    /**
     * @return string[]
     */
    public function rootChildren() : array;
    public function index(string $alias) : string;
    public function rootIndex() : string;
}
