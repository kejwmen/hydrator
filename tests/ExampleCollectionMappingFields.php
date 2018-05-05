<?php

declare(strict_types=1);

namespace kejwmen\Hydrator\Tests;

final class ExampleCollectionMappingFields
{
    /**
     * @return string[]
     */
    public static function order() : array
    {
        return ['order_id', 'order_amount'];
    }

    /**
     * @return string[]
     */
    public static function orderItems() : array
    {
        return ['item_id', 'item_name', 'item_price', 'item_quantity'];
    }

    /**
     * @return string[]
     */
    public static function orderItemCategories() : array
    {
        return ['category_id', 'category_name'];
    }

    /**
     * @return string[]
     */
    public static function orderItemVariants() : array
    {
        return ['variant_id', 'variant_name'];
    }
}
