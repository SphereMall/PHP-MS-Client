<?php


namespace SphereMall\MS\Lib\SortParams\ElasticSearch\ByFactorValues\Algorithms;

/**
 * Class Relevant
 *
 * @package SphereMall\MS\Lib\SortParams\ElasticSearch\ByFactorValues\Algorithms
 */
class Relevant extends BasicAlgorithm
{
    const DEFAULT_FACTOR = 0.00001;

    private $relevant         = [];
    private $ignoreAttributes = [];

    /**
     * Relevant constructor.
     *
     * @param array $relevant
     * @param array $ignoreAttributes
     */
    public function __construct(array $relevant, array $ignoreAttributes)
    {
        $this->relevant         = $relevant;
        $this->ignoreAttributes = $ignoreAttributes;
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
     * @return string
     */
    private function getScriptSource()
    {
        return "
            double factor = " . self::DEFAULT_FACTOR . "; 
            try { 
              factor = params.factors[doc['_type'].value][doc['_id'].value];
            } 
            catch (NullPointerException e) { 
              factor =" . self::DEFAULT_FACTOR . ";
            } 
            ".(!empty($this->ignoreAttributes) ? "for(int i=0; i < params.ignoreAttrCode.length; i++){
              if (doc[params.ignoreAttrCode[i] + '.id'].value != 0.0){
                return 0;
              }
            } " : "").
            "return factor;";
    }

    /**
     * @return array
     */
    private function getParams()
    {
        return [
            'factors'    => $this->relevant,
            'ignoreAttrCode' => $this->ignoreAttributes,
        ];
    }

}
