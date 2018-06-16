<?php
/**
 * Created by PhpStorm.
 * User: BohdanBabitskyi
 * Date: 15.06.2018
 * Time: 13:07
 */
namespace SphereMall\MS\Resources\Prices;

use SphereMall\MS\Exceptions\EntityNotFoundException;
use SphereMall\MS\Exceptions\MethodNotFoundException;
use SphereMall\MS\Resources\Resource;
use SphereMall\MS\Lib\Prices\PriceProductDetail;

class FindDetailPricesResource extends Resource
{
    #region [Override methods]
    /**
     * @return string
     */
    public function getURI()
    {
        return "finddetailprices";
    }

    /**
     * @param int $id
     *
     * @throws \Exception
     */
    public function get(int $id)
    {
        throw new MethodNotFoundException("Method get() can not be use with correlations");
    }

    /**
     * @param $id
     * @param $data
     *
     * @throws Exception
     */
    public function update($id, $data)
    {
        throw new MethodNotFoundException("Method update() can not be use with correlations");
    }

    /**
     * @param $data
     *
     * @throws Exception
     */
    public function create($data)
    {
        throw new MethodNotFoundException("Method create() can not be use with correlations");
    }

    /**
     * @param $id
     *
     * @return bool|void
     * @throws Exception
     */
    public function delete($id)
    {
        throw new MethodNotFoundException("Method delete() can not be use with correlations");
    }
    #endregion

    #region [Public methods]
    /**
     * @param $product
     * @return array|int|\SphereMall\MS\Entities\Entity|\SphereMall\MS\Lib\Collection
     */
    public function findPrice(PriceProductDetail $priceProductDetail)
    {
        $response = $this->handler->handle('POST', $priceProductDetail->getData());

        if (!$response->getSuccess()) {
            throw new EntityNotFoundException($response->getErrorMessage());
        }

        return $this->make($response);
    }
    #endregion
}