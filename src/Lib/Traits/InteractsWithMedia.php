<?php
/**
 * Created by PhpStorm.
 * User: DimaSarno
 * Date: 10.08.2018
 * Time: 11:37
 */

namespace SphereMall\MS\Lib\Traits;

use SphereMall\MS\Entities\Media;
use SphereMall\MS\Lib\Specifications\Media\MediaTypes;

/**
 * Trait InteractsWithMedia
 * @package SphereMall\MS\Lib\Traits
 * @property Media[] $images
 * @property Media[] $files
 * @property Media[] $videos
 *
 */
trait InteractsWithMedia
{

    public $images = [];
    public $files = [];
    public $videos = [];

    /**
     * @return Media|null
     */
    public function getMainImage()
    {
        $images = $this->getImages();
        return $images[0] ?? null;
    }

    #region [Images]
    /**
     * @return array
     */
    public function getImages()
    {
        if(!empty($this->images)) {
            return $this->images;
        }
        $this->setImages();
        return $this->images;
    }

    private function setImages()
    {
        $images = [];
        foreach($this->media as $media) {
            if($media->properties['mediaTypeId'] == MediaTypes::IMAGE_TYPE) {
                $images[] = $media;
            }
        }
        $this->images = $this->sortMedia($images);
    }
    #endregion

    #region [Files]
    /**
     * @return array
     */
    public function getFiles()
    {
        if(!empty($this->files)) {
            return $this->files;
        }
        $this->setFiles();
        return $this->files;
    }

    private function setFiles()
    {
        $files = [];
        foreach($this->media as $media) {
            if($media->properties['mediaTypeId'] == MediaTypes::FILE_TYPE) {
                $files[] = $media;
            }
        }
        $this->files = $this->sortMedia($files);
    }
    #endregion

    #region [Videos]
    /**
     * @return array
     */
    public function getVideos()
    {
        if(!empty($this->videos)) {
            return $this->images;
        }
        $this->setVideos();
        return $this->videos;
    }

    private function setVideos()
    {
        $videos = [];
        foreach($this->media as $media) {
            if($media->properties['mediaTypeId'] == MediaTypes::VIDEO_TYPE) {
                $videos[] = $media;
            }
        }
        $this->videos = $this->sortMedia($videos);
    }
    #endregion

    #region [Private methods]
    private function sortMedia(array $media)
    {
        if(empty($media)) {
            return [];
        }
        usort($media, function ($a, $b) {
            if ($a->orderNumber == $b->orderNumber) {
                return 0;
            }
            return ($a->orderNumber < $b->orderNumber) ? -1 : 1;
        });
        return $media;
    }
    #endregion
}