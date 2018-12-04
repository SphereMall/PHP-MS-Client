<?php
/**
 * Created by PhpStorm.
 * User: Davidych
 * Date: 04.12.18
 * Time: 9:48
 */

namespace SphereMall\MS\Lib\Filters\Interfaces;


interface ElasticQueryInterface
{
    public function getData();

    public function buildQuery(array $elements): array;
}
