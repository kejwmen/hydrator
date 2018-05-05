<?php

declare(strict_types=1);

namespace kejwmen\Hydrator;

interface Hydrator
{
    /**
     * @param mixed[] $data
     *
     * @return mixed
     */
    public function hydrate(array $data);
}
