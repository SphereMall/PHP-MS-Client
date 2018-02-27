<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 20.02.2018
 * Time: 9:45
 */

namespace SphereMall\MS\Lib\Filters\ElasticSearch;

use SphereMall\MS\Lib\FilterParams\FilterParams;
use SphereMall\MS\Lib\FilterParams\Interfaces\FacetedParamsInterface;
use SphereMall\MS\Lib\FilterParams\Interfaces\SearchParamsInterface;
use SphereMall\MS\Lib\Filters\Interfaces\SearchInterface;

/**
 * Class ElasticSearchFilterElement
 * @package SphereMall\MS\Lib\Filters\Grid
 * @property string $name
 * @property array  $values
 * @property array  $facets
 * @property string $condition
 */
class ElasticSearchFilterElement implements SearchInterface
{
    #region [Properties]
    protected $name;
    protected $values;
    protected $facets;
    protected $langCodes;
    #endregion

    #region [Constructor]
    /**
     * ElasticSearchFilterElement constructor.
     * @param FilterParams $values
     * @param array|null   $langs
     */
    public function __construct(FilterParams $values, array $langs = null)
    {
        if (is_a($values, SearchParamsInterface::class)) {
            $this->values = $values->getParams();
        }
        if (is_a($values, FacetedParamsInterface::class)) {
            $this->facets = $values->getFacetedParams();
        }
        if ($langs) {
            foreach ($langs as $lang) {
                $this->langCodes[] = strtolower($lang);
            }
        }
    }
    #endregion

    #region [Public methods]
    /**
     * @return array
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    #endregion
}
