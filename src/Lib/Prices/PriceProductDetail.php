<?php
/**
 * Created by PhpStorm.
 * User: BohdanBabitskyi
 * Date: 15.06.2018
 * Time: 13:40
 */

namespace SphereMall\MS\Lib\Prices;

class PriceProductDetail
{
    #region [Properties]
    public $productId;
    public $attributes;
    public $options;
    #endregion

    #region [Constructor]
    public function __construct(int $productId, $attributes, $options)
    {
        $this->productId = $productId;
        $this->attributes = $attributes;
        $this->options = $options;
    }

    #endregion

    public function getData()
    {
        $attributes = [];
        $options = [];

        foreach ($this->attributes as $attributeId => $attributeValueId) {
            $value = [
                'attributeId' => $attributeId,
                'attributeValueId' => $attributeValueId
            ];

            $value['userValue'] = $userAttributes[$attributeId] ?? '';
            $attributes[] = $value;
        }

        foreach ($this->options ?? [] as $optionId => $optionValueId) {
            $options[] = ['optionId' => $optionId, 'optionValueId' => (string)$optionValueId];
        }

        return [
            'products' => json_encode([
                [
                    "id" => $this->productId,
                    "type" => "product",
                    "attributes" => [
                        'attributes' => $attributes,
                        'options' => $options,
                        'productId' => $this->productId
                    ]
                ]
            ])
        ];
    }
}