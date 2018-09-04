<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 04.09.18
 * Time: 10:41
 */

namespace SphereMall\MS\Lib\Filters\ElasticSearch;

use SphereMall\MS\Lib\Filters\Interfaces\AutoCompleteInterface;

class ShouldSearchFilter extends SearchFilter
{
    /**
     * This method give opportunity to use OR operator
     * @return array
     */
    public function getSearchFilters(): array
    {
        parent::getSearchFilters();

        $set = $this->addIndexToFilters();
        if (empty($this->elements)) {
            return $set;
        }

        foreach ($this->elements as $element) {
            $set['body']['query']['bool']['should'][] = $element->getValues();
            if (is_a($element, AutoCompleteInterface::class)) {
                $set['body']['highlight'] = $element->getHighlight();
            }
        }

        return $set;
    }
}