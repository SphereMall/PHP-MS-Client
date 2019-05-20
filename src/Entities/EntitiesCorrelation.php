<?php

namespace SphereMall\MS\Entities;

/**
 * Class EntitiesCorrelation
 *
 * @package SphereMall\MS\Entities
 *
 * @property string           $type
 * @property float            $value
 * @property int              $fromEntityId
 *
 * @property Product[]        $products
 * @property Brand[]          $brands
 * @property Promotion[]      $promotions
 * @property Document[]       $documents
 * @property FunctionalName[] $functionalNames
 * @property Category[]       $categories
 * @property EntityGroup[]    $entityGroups
 * @property Page[]           $pages
 */
class EntitiesCorrelation extends Entity
{
    protected $type;
    protected $value;
    protected $fromEntityId;

    protected $products;
    protected $brands;
    protected $promotions;
    protected $documents;
    protected $functionalNames;
    protected $categories;
    protected $entityGroups;
    protected $pages;
}
