<?php
/**
 * Created by PHPStorm.
 * User: Serhii Kondratovec
 * Email: sergey@spheremall.com
 * Date: 13.10.2017
 * Time: 19:10
 */

namespace SphereMall\MS\Resources\Documents;

use SphereMall\MS\Entities\Document;
use SphereMall\MS\Resources\Resource;
use SphereMall\MS\Resources\Traits\FullResource;

/**
 * Class DocumentsResource
 * @package SphereMall\MS\Resources\Products
 * @method Document get(int $id)
 * @method Document first()
 * @method Document[] all()
 * @method Document update($id, $data)
 * @method Document create($data)
 * @method Document|Document[] full($param = null)
 * @method Document[] fullAll()
 * @method Document fullById(int $id)
 * @method Document fullByCode(string $code)
 */
class DocumentsResource extends Resource
{
    use FullResource;

    #region [Override methods]

    /**
     * @return string
     */
    public function getURI()
    {
        return "documents";
    }
    #endregion
}
