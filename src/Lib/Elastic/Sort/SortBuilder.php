<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 25.02.19
 * Time: 13:37
 */

namespace SphereMall\MS\Lib\Elastic\Sort;


use SphereMall\MS\Lib\Elastic\Interfaces\ElasticBodyElementInterface;
use SphereMall\MS\Lib\Elastic\Builders\QueryBuilder;
use SphereMall\MS\Lib\Elastic\Queries\{MustNotQuery, MustQuery, ShouldQuery, TermQuery, TermsQuery};

/**
 * Class SortBuilder
 *
 * @package SphereMall\MS\Lib\Elastic\Sort
 */
class SortBuilder implements ElasticBodyElementInterface
{
    private $elements = [];

    /**
     * SortBuilder constructor.
     *
     * @param array $sortElements
     */
    public function __construct(array $sortElements)
    {
        foreach ($sortElements as $element) {
            $this->setSort($element);
        }
    }

    /**
     * Convert to array
     *
     * @return array
     */
    public function toArray(): array
    {
        $array = array_map(function (ElasticBodyElementInterface $sort) {
            return $sort->toArray();
        }, $this->elements);

        return $array;
    }

    /**
     * @param ElasticBodyElementInterface $element
     *
     * @return $this
     */
    public function setSort(ElasticBodyElementInterface $element)
    {
        $this->elements[] = $element;

        return $this;
    }

    /**
     * @param array $query
     *
     * @return array
     */
    public function excludeNegativeFactorItems(array $query): array
    {
        $additionalQuery   = [];
        $entitiesToExclude = [];

        foreach ($this->elements as $sort) {
            /** @var SortElement $sort */
            if (!$factors = $sort->getScriptNegativeFactors()) {
                continue;
            }
            foreach ($factors as $entity => $objectIds) {
                $entitiesToExclude[$entity] = array_merge($entitiesToExclude[$entity] ?? [], $objectIds);
            }
        }

        foreach ($entitiesToExclude as $entity => $objectIds) {
            $additionalQuery[] = new MustQuery([
                new MustQuery([new TermQuery('_type', $entity)]),
                new MustNotQuery([new TermsQuery('_id', $objectIds)]),
            ]);
        }

        if ($additionalQuery && isset($query['bool']['must'])) {
            $query['bool']['must'][] = (new QueryBuilder)->setShould(new ShouldQuery($additionalQuery))->toArray();
        }

        return $query;
    }
}
