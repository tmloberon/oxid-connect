<?php

namespace Makaira\Connect\Modifier\Product;

use Makaira\Connect\Modifier;
use Makaira\Connect\Type;
use Makaira\Connect\Type\Common\BaseProduct;

class SuggestModifier extends Modifier
{
    private $suggestFields = [];

    /**
     * SuggestModifier constructor.
     *
     * @param array $suggestFields
     */
    public function __construct(array $suggestFields)
    {
        $this->suggestFields = $suggestFields;
    }

    /**
     * Modify product and return modified product
     *
     * @param BaseProduct $product
     *
     * @return BaseProduct
     */
    public function apply(Type $product)
    {
        $suggest = [];
        foreach ($this->suggestFields as $suggestField) {
            $suggest[] = $product->$suggestField;
        }
        $suggest          = explode(',', join(',', $suggest));
        $suggest          = array_unique(array_map('trim', $suggest));
        $product->suggest = $suggest;

        return $product;
    }
}