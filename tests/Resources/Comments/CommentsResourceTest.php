<?php
/**
 * Created by PHPStorm.
 * User: Slavik
 * Date: 20-May-2019
 * Time: 17:36
 */

namespace SphereMall\MS\Tests\Resources\Comments;

use SphereMall\MS\Entities\Comment;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

/**
 * Class CommentsResourceTest
 *
 * @package SphereMall\MS\Tests\Resources\Comments
 */
class CommentsResourceTest extends SetUpResourceTest
{
    #region [Test methods]
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SphereMall\MS\Exceptions\EntityNotFoundException
     */
    public function testCRUDs()
    {
        $this->assertNotEmpty($this->client->comments()->all());
        $this->assertInstanceOf(Comment::class, $this->client->comments()->get(3));
        $this->assertInstanceOf(Comment::class, $this->client->comments()->create([
            'channelId' => 1,
            'entityId'  => 1,
            'objectId'  => 5,
            'visible'   => 1,
            'userId'    => 1
        ]));
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testCommentsWithRating()
    {
        $comments = $this->client->comments()->getCommentsWithRating(
            [
                [
                    'entityId' => 1,
                    'objectId' => 1
                ],
                [
                    'entityId' => 1,
                    'objectId' => 2
                ]
            ]
        );

        $this->assertNotEmpty($comments);

        foreach ($comments as $comment) {
            $this->assertInstanceOf(Comment::class, $comment);
            $this->assertObjectHasAttribute('entitiesAverageRating', $comment);
            $this->assertNotEmpty($comment->entitiesAverageRating);
        }
    }
    #endregion
}
