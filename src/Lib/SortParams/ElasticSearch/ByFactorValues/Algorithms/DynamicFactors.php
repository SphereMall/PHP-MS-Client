<?php


namespace SphereMall\MS\Lib\SortParams\ElasticSearch\ByFactorValues\Algorithms;

/**
 * Class DynamicFactors
 *
 * @package SphereMall\MS\Lib\SortParams\ElasticSearch\ByFactorValues\Algorithms
 */
class DynamicFactors extends BasicAlgorithm
{
    private $factors    = [];
    private $attributes = [];

    /**
     * DynamicFactors constructor.
     *
     * @param array $factors
     * @param array $attributeCodes
     */
    public function __construct(array $factors, array $attributeCodes = [])
    {
        $this->factors    = $factors;
        $this->attributes = $this->attributesToFormat($attributeCodes);
    }

    /**
     * @return array
     */
    public function getAlgorithm(): array
    {
        return [
            'lang'   => 'painless',
            'source' => $this->getScriptSource(),
            'params' => $this->getParams(),
        ];
    }

    /**
     * @param array $attributes
     *
     * @return array
     */
    private function attributesToFormat(array $attributes)
    {
        return array_map(function ($attributes) {
            return "{$attributes}_attr";
        }, $attributes);
    }

    /**
     * @return array
     */
    private function getParams()
    {
        return array_merge($this->factors, [
            'ignoreAttrCode' => $this->attributes,
        ]);
    }

    /**
     * @return string
     */
    private function getScriptSource()
    {
        return "
          double factor = 0;
          
          for(int i=0; i < params.ignoreAttrCode.length; i++){
            if (doc[params.ignoreAttrCode[i] + '.id'].value != 0.0) {
              return 0;
            }
          }
          
          try {
              factor = params[doc['_type'].value][doc['_id'].value];
          } catch (NullPointerException e) {
              factor = 0.00001;
          }
          
          return factor;
        ";
    }

}
