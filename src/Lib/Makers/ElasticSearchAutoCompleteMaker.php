<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 19.02.2018
 * Time: 16:44
 */

namespace SphereMall\MS\Lib\Makers;

use SphereMall\MS\Exceptions\EntityNotFoundException;
use SphereMall\MS\Lib\Collection;
use SphereMall\MS\Lib\Http\ElasticSearchResponse;
use SphereMall\MS\Lib\Http\Meta;

// ToDo: extends Maker or ObjectMaker with overriding

/**
 * Class ElasticSearchMaker
 * @package SphereMall\MS\Lib\Makers
 *
 * @property bool $asCollection
 */
class ElasticSearchAutoCompleteMaker extends ElasticSearchMaker
{
    protected $langCodes = [];

    /**
     * ElasticSearchAutoCompleteMaker constructor.
     * @param array $langCodes
     */
    public function __construct($langCodes = [])
    {
        $this->langCodes = $langCodes;
    }

    /**
     * @param ElasticSearchResponse $response
     * @return array
     * @throws EntityNotFoundException
     */
    protected function getResultFromResponse(ElasticSearchResponse $response)
    {
        $result = [];

        foreach ($response->getData()['hits']['hits'] as $element) {
            $mapperClass = $this->getMapperClass($element['_type']);
            if (is_null($mapperClass)) {
                throw new EntityNotFoundException("Entity mapper class for {$element['_type']} was not found");
            }

            if (!$element['_source']) {
                continue;
            }

            foreach ($this->langCodes as $language) {
                $el = [
                    'id' => $element['_id'],
                    'title' => $element['highlight']["title_{$language}.autocomplete"][0] ?? $element['_source']['title_'.$language],
                    'urlCode' => $element['_source']['urlCode'],
                ];

                $result[] = $this->createObject($mapperClass, $el);
            }
        }

        return $result;
    }
}
