<?php

declare(strict_types=1);

namespace kejwmen\Hydrator\Tests;

final class ArrayHydratorTestData
{
    /**
     * @return mixed[]
     */
    public static function flatMapping() : array
    {
        return [
            'foo' => [
                'parent' => null,
                'children' => [],
                'index' => 'foo',
                'fields' => ['foo', 'baz'],
            ],
        ];
    }

    /**
     * @return mixed[]
     */
    public static function flatInputData() : array
    {
        return [
            [
                'foo' => 'bar',
                'baz' => 'zaz',
            ],
        ];
    }

    /**
     * @return mixed[]
     */
    public static function flatExpectation() : array
    {
        return self::flatInputData();
    }

    /**
     * @return mixed[]
     */
    public static function simpleMapping() : array
    {
        return [
            'foo' => [
                'parent' => null,
                'children' => ['bazes'],
                'index' => 'foo',
                'fields' => ['foo'],
            ],
            'bazes' => [
                'parent' => 'foo',
                'children' => [],
                'index' => 'baz',
                'fields' => ['baz'],
            ],
        ];
    }

    /**
     * @return mixed[]
     */
    public static function simpleInputData() : array
    {
        return [
            [
                'foo' => 'bar',
                'baz' => 'qwe',
            ],
            [
                'foo' => 'bar',
                'baz' => 'asd',
            ],
            [
                'foo' => 'not_bar',
                'baz' => 'zxc',
            ],
        ];
    }

    /**
     * @return mixed[]
     */
    public static function simpleExpectation() : array
    {
        return [
            [
                'foo' => 'bar',
                'bazes' => [
                    ['baz' => 'qwe'],
                    ['baz' => 'asd'],
                ],
            ],
            [
                'foo' => 'not_bar',
                'bazes' => [
                    ['baz' => 'zxc'],
                ],
            ],
        ];
    }

    /**
     * @return mixed[]
     */
    public static function complexMapping() : array
    {
        return [
            'orders' => [
                'parent' => null,
                'children' => ['orderItems'],
                'index' => 'order_id',
                'fields' => ExampleCollectionMappingFields::order(),
            ],
            'orderItems' => [
                'parent' => 'orders',
                'children' => ['orderItemCategories', 'orderItemVariants'],
                'index' => 'item_id',
                'fields' => ExampleCollectionMappingFields::orderItems(),
            ],
            'orderItemCategories' => [
                'parent' => 'orderItems',
                'children' => [],
                'index' => 'category_id',
                'fields' => ExampleCollectionMappingFields::orderItemCategories(),
            ],
            'orderItemVariants' => [
                'parent' => 'orderItems',
                'children' => [],
                'index' => 'variant_id',
                'fields' => ExampleCollectionMappingFields::orderItemVariants(),
            ],
        ];
    }

    /**
     * @return mixed[]
     */
    public static function complexInputData() : array
    {
        return [
            [
                'order_id' => 15,
                'order_amount' => 1.23,
                'item_id' => 456,
                'item_name' => 'foo',
                'item_price' => 0.5,
                'item_quantity' => 2,
                'category_id' => 1,
                'category_name' => 'lol',
                'variant_id' => 987,
                'variant_name' => 'nice',
            ],
            [
                'order_id' => 40,
                'order_amount' => 20,
                'item_id' => 456,
                'item_name' => 'foo',
                'item_price' => 0.5,
                'item_quantity' => 40,
                'category_id' => 5,
                'category_name' => 'rotfl',
                'variant_id' => 987,
                'variant_name' => 'nice',
            ],
            [
                'order_id' => 15,
                'order_amount' => 1.23,
                'item_id' => 321,
                'item_name' => 'bar',
                'item_price' => 0.1,
                'item_quantity' => 1,
                'category_id' => 1,
                'category_name' => 'lol',
                'variant_id' => 654,
                'variant_name' => 'woo',
            ],
            [
                'order_id' => 15,
                'order_amount' => 1.23,
                'item_id' => 456,
                'item_name' => 'foo',
                'item_price' => 0.5,
                'item_quantity' => 2,
                'category_id' => 20,
                'category_name' => 'qwe',
                'variant_id' => 987,
                'variant_name' => 'nice',
            ],
            [
                'order_id' => 15,
                'order_amount' => 1.23,
                'item_id' => 321,
                'item_name' => 'bar',
                'item_price' => 0.1,
                'item_quantity' => 1,
                'category_id' => 2,
                'category_name' => 'rty',
                'variant_id' => 654,
                'variant_name' => 'woo',
            ],
        ];
    }

    /**
     * @return mixed[]
     */
    public static function complexExpectation() : array
    {
        return [
            [
                'order_id' => 15,
                'order_amount' => 1.23,
                'orderItems' => [
                    [
                        'item_id' => 456,
                        'item_name' => 'foo',
                        'item_price' => 0.5,
                        'item_quantity' => 2,
                        'orderItemCategories' => [
                            [
                                'category_id' => 1,
                                'category_name' => 'lol',
                            ],
                            [
                                'category_id' => 20,
                                'category_name' => 'qwe',
                            ],
                        ],
                        'orderItemVariants' => [
                            [
                                'variant_id' => 987,
                                'variant_name' => 'nice',
                            ],
                        ],
                    ],
                    [
                        'item_id' => 321,
                        'item_name' => 'bar',
                        'item_price' => 0.1,
                        'item_quantity' => 1,
                        'orderItemCategories' => [
                            [
                                'category_id' => 1,
                                'category_name' => 'lol',
                            ],
                            [
                                'category_id' => 2,
                                'category_name' => 'rty',
                            ],
                        ],
                        'orderItemVariants' => [
                            [
                                'variant_id' => 654,
                                'variant_name' => 'woo',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'order_id' => 40,
                'order_amount' => 20,
                'orderItems' => [
                    [
                        'item_id' => 456,
                        'item_name' => 'foo',
                        'item_price' => 0.5,
                        'item_quantity' => 40,
                        'orderItemCategories' => [
                            [
                                'category_id' => 5,
                                'category_name' => 'rotfl',
                            ],
                        ],
                        'orderItemVariants' => [
                            [
                                'variant_id' => 987,
                                'variant_name' => 'nice',
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }
}
