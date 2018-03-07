<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 20.02.2018
 * Time: 15:01
 */

namespace SphereMall\MS\Lib\Filters\ElasticSearch;

use SphereMall\MS\Exceptions\ConfigurationException;
use SphereMall\MS\Lib\Filters\Interfaces\AutoCompleteInterface;
use SphereMall\MS\Lib\Filters\Interfaces\SearchInterface;

/**
 * Class MatchFilter
 * @package SphereMall\MS\Lib\Filters\ElasticSearch
 * @property string $name
 * @property string $highLightTagPre
 * @property string $highLightTagPost
 */
class AutoCompleteFilter extends ElasticSearchFilterElement implements SearchInterface, AutoCompleteInterface
{
    protected $name              = 'match';
    protected $highLightTagPre   = '<em>';
    protected $highLightTagPost  = '</em>';
    protected $autoCompleteField = 'autocomplete';

    /**
     * @return array
     * @throws ConfigurationException
     */
    public function getValues()
    {
        if (sizeof($this->langCodes) < 1) {
            throw new ConfigurationException('No lang codes selected');
        }

        return $this->combineParams();
    }

    /**
     * @param $pre
     * @param $post
     * @return $this
     */
    public function highLightTags($pre, $post)
    {
        $this->highLightTagPost = $post;
        $this->highLightTagPre  = $pre;

        return $this;
    }

    /**
     * @return array|mixed
     */
    public function getHighlight()
    {
        return [
            'pre_tags'  => $this->highLightTagPre,
            'post_tags' => $this->highLightTagPost,
            'fields'    => $this->combineParams(true),
        ];
    }



    /**
     * @param $result
     * @param $value
     * @param $isHighlight
     * @param $key
     * @return mixed
     */
    protected function combineParamValues($result, $value, $isHighlight, $key)
    {
        foreach ($this->langCodes as $langCode) {
            if ($isHighlight) {
                $result[$this->createKey($key, $langCode)] = $this->defaultValue();
            }
            if (!$isHighlight) {
                $result[$this->getName()][$this->createKey($key, $langCode)] = $value;
            }
        }

        return $result;
    }
    /**
     * @param bool $isHighlight
     * @return array
     */
    protected function combineParams($isHighlight = false)
    {
        $result = [];

        foreach ($this->values as $key => $value) {
            $result = $this->combineParamValues($result, $value, $isHighlight, $key);
        }

        return $result;
    }

    /**
     * @param $key
     * @param $langCode
     * @return string
     */
    protected function createKey($key, $langCode): string
    {
        return "{$key}_{$langCode}.{$this->autoCompleteField}";
    }

    /**
     * @return array
     */
    protected function defaultValue(): array
    {
        return [
            'type'                => 'fvh',
            'number_of_fragments' => 0,
            'force_source'        => true,
        ];
    }
}
