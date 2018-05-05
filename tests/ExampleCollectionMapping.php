<?php

declare(strict_types=1);

namespace kejwmen\Hydrator\Tests;

final class ExampleCollectionMapping
{
    /**
     * @return mixed[]
     */
    public static function nested() : array
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
}
