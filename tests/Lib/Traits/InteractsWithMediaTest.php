<?php
/**
 * Created by PhpStorm.
 * User: DimaSarno
 * Date: 10.08.2018
 * Time: 13:57
 */

namespace SphereMall\MS\Tests\Lib\Traits;


use SphereMall\MS\Entities\Media;
use SphereMall\MS\Entities\Document;
use SphereMall\MS\Tests\Resources\SetUpResourceTest;

class InteractsWithMediaTest extends SetUpResourceTest
{

    /**
     * @test
     */
    public function testGetMainImage()
    {
        $document = $this->getMockedDocument();
        $img = $document->getMainImage();
        $this->assertEquals('img1.png', $img->path);
    }

    /**
     * @test
     */
    public function testGetImages()
    {
        $document = $this->getMockedDocument();
        $images = $document->getImages();
        $this->assertEquals(3, count($images));
    }

    /**
     * @test
     */
    public function testGetFiles()
    {
        $document = $this->getMockedDocument();
        $files = $document->getFiles();
        $this->assertEquals(1, count($files));
    }

    /**
     * @test
     */
    public function testGetVideos()
    {
        $document = $this->getMockedDocument();
        $videos = $document->getVideos();
        $this->assertEquals(2, count($videos));
    }

    /**
     * @return Document
     */
    private function getMockedDocument()
    {
        $document = new Document();
        $img1 = new Media(['id' => 1, 'path' => 'img1.png', 'orderNumber' => 1, 'mediaTypeId' => 1]);
        $img2 = new Media(['id' => 1, 'path' => 'img2.png', 'orderNumber' => 3, 'mediaTypeId' => 1]);
        $img3 = new Media(['id' => 1, 'path' => 'img3.png', 'orderNumber' => 2, 'mediaTypeId' => 1]);
        $file = new Media(['id' => 1, 'path' => 'file.pdf', 'orderNumber' => 1, 'mediaTypeId' => 2]);
        $video1 = new Media(['id' => 1, 'path' => 'video.avi', 'orderNumber' => 1, 'mediaTypeId' => 3]);
        $video2 = new Media(['id' => 1, 'path' => 'video1.avi', 'orderNumber' => 1, 'mediaTypeId' => 3]);
        $document->media = [$img1, $img2, $img3, $file, $video1, $video2];
        return $document;
    }

}
