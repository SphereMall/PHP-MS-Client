<?php
/**
 * Created by SergeyBondarchuk.
 * 23.04.2018 17:46
 */

namespace SphereMall\MS\Resources\StaticTexts;


use SphereMall\MS\Entities\WebText;
use SphereMall\MS\Exceptions\EntityNotFoundException;
use SphereMall\MS\Lib\Collection;
use SphereMall\MS\Resources\Resource;

/**
 * Class WebTextsResource
 * @package SphereMall\MS\Resources\StaticTexts
 */
class WebTextsResource extends Resource
{
    function getURI()
    {
        return "webtexts";
    }

    /**
     * @param array $data
     * @return Collection|WebText[]
     * @throws EntityNotFoundException
     */
    public function createList(array $data)
    {
        $response = $this->handler->handle('POST', $data, 'bykeywords');
        if (!$response->getSuccess()) {
            throw new EntityNotFoundException($response->getErrorMessage());
        }

        return $this->make($response);
    }

    /**
     * @param array $data
     * @return Collection|WebText[]
     * @throws EntityNotFoundException
     */
    public function updateList(array $data)
    {
        $response = $this->handler->handle('PATCH', $data, 'bykeywords');
        if (!$response->getSuccess()) {
            throw new EntityNotFoundException($response->getErrorMessage());
        }

        return $this->make($response);
    }
}