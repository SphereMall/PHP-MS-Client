<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Rokytskyi
 * Date: 31.08.2018
 * Time: 15:56
 */

namespace SphereMall\MS\Resources\Comments;

use SphereMall\MS\Entities\Comment;
use SphereMall\MS\Resources\Resource;

/**
 * Class CommentsResource
 *
 * @package SphereMall\MS\Resources\Comments
 *
 * @method Comment   get(int $id)
 * @method Comment   first()
 * @method Comment[] all()
 * @method Comment   update($id, $data)
 * @method Comment   create($data)
 */
class CommentsResource extends Resource
{
    public function getURI()
    {
        return 'comments';
    }

    /**
     * @param array $objects - list of needed objects if the following format:
     * [
     *     [
     *        'entityId' => 1,
     *        'objectId' => 1
     *     ],
     *     [
     *        'entityId' => 1,
     *        'objectId' => 2
     *     ],
     * ]
     *
     *
     * @return array|int|\SphereMall\MS\Entities\Entity|\SphereMall\MS\Lib\Collection
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCommentsWithRating(array $objects)
    {
        $uriAppend = 'withrating';

        $response = $this->handler->handle('GET', $objects, $uriAppend);

        return $this->make($response);
    }
}
