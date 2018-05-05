<?php

declare(strict_types=1);

namespace kejwmen\Hydrator\Tests;

use kejwmen\Hydrator\NestedArrayHydratorMapping;
use PHPUnit\Framework\TestCase;

final class NestedArrayHydratorMappingTest extends TestCase
{
    /**
     * @test
     * @dataProvider fieldsForAliasDataProvider
     *
     * @param string[] $expectedFields
     */
    public function shouldReturnFieldsForAlias(string $alias, array $expectedFields) : void
    {
        // given
        $mapping = new NestedArrayHydratorMapping(ExampleCollectionMapping::nested());

        // when
        $result = $mapping->fields($alias);

        // then
        $this->assertSame($expectedFields, $result);
    }

    /**
     * @return mixed[]
     */
    public function fieldsForAliasDataProvider() : iterable
    {
        yield ['orders', ExampleCollectionMappingFields::order()];
        yield ['orderItems', ExampleCollectionMappingFields::orderItems()];
        yield ['orderItemCategories', ExampleCollectionMappingFields::orderItemCategories()];
    }
}
