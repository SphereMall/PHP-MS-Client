<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 08.10.2017
 * Time: 21:37
 */

namespace SphereMall\MS\Entities;

/**
 * Class OrderItem
 * @package SphereMall\MS\Entities
 * @property int $id
 * @property int $orderId
 * @property int $amount
 * @property int $promotionId
 * @property string $compound
 * @property int $itemPrice
 * @property int $itemDiscountPrice
 * @property int $itemPriceWithDiscount
 * @property int $vatId
 * @property int $itemVatPrice
 * @property int $itemVatExcludePrice
 * @property int $totalPrice
 * @property Product $product
 */
class OrderItem extends Entity
{
    #region [Properties]
    public $id;
    public $orderId;
    public $amount;
    public $promotionId;
    public $compound;
    public $itemPrice;
    public $itemDiscountPrice;
    public $itemPriceWithDiscount;
    public $vatId;
    public $itemVatPrice;
    public $itemVatExcludePrice;
    public $totalPrice;

    public $product;
    public $options;
    #endregion

	#region [Public methods]
	/**
	 * @return array
	 */
	public function getSelectedOptions()
	{
		$optionValueIds = json_decode($this->optionsDetail);
		foreach ($optionValueIds ?? [] as $optionValueId) {
			foreach ($this->product->options as $option) {
				foreach ($option->values as $optionValue) {
					if ($optionValue->id == $optionValueId && floatval($optionValue->price)) {
						$option->totalPriceWithVat = $optionValue->totalPriceWithVat;
						$selectedOptions[] = $option;
						return $selectedOptions;
					}
				}
			}
		}
	}
	#endregion
}