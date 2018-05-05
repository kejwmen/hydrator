<?php

declare(strict_types=1);

namespace kejwmen\Hydrator\Tests;

use kejwmen\Hydrator\ArrayHydrator;
use kejwmen\Hydrator\NestedArrayHydratorMapping;
use PHPUnit\Framework\TestCase;

final class ArrayHydratorTest extends TestCase
{
    /**
     * @test
     * @dataProvider hydrationDataProvider
     *
     * @param mixed[] $mappingArray
     * @param mixed[] $input
     * @param mixed[] $expectation
     */
    public function shouldHydrateToExpectedArray(array $mappingArray, array $input, array $expectation) : void
    {
        // given
        $mapping  = new NestedArrayHydratorMapping($mappingArray);
        $hydrator = new ArrayHydrator($mapping);

        // when
        $result = $hydrator->hydrate($input);

        // then
        $this->assertSame($expectation, $result);
    }

    /**
     * @return mixed[]
     */
    public function hydrationDataProvider() : iterable
    {
        yield [
            ArrayHydratorTestData::flatMapping(),
            ArrayHydratorTestData::flatInputData(),
            ArrayHydratorTestData::flatExpectation(),
        ];

        yield [
            ArrayHydratorTestData::simpleMapping(),
            ArrayHydratorTestData::simpleInputData(),
            ArrayHydratorTestData::simpleExpectation(),
        ];

        yield [
            ArrayHydratorTestData::complexMapping(),
            ArrayHydratorTestData::complexInputData(),
            ArrayHydratorTestData::complexExpectation(),
        ];
    }
}
