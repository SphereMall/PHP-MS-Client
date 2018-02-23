<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 20.02.2018
 * Time: 9:45
 */

namespace SphereMall\MS\Lib\Filters\ElasticSearch;

use SphereMall\MS\Lib\FilterParams\FilterParams;

/**
 * Class ElasticSearchFilterElement
 * @package SphereMall\MS\Lib\Filters\Grid
 * @property string $name
 * @property array  $values
 * @property string $condition
 */
class ElasticSearchFilterElement
{
    #region [Properties]
    protected $name;
    protected $values;
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
        $this->values    = $values->getParams();
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
