<?php
/**
 * Created by PhpStorm.
 * User: DmitriyVorobey
 * Date: 21.02.2018
 * Time: 12:03
 */

namespace SphereMall\MS\Lib\Filters\ElasticSearch;

/**
 * Class MatchPhraseFilter
 * @package SphereMall\MS\Lib\Filters\ElasticSearch
 * @property string $name
 */
class MatchPhraseFilter extends MatchFilter
{
    protected $name = 'match_phrase';
}
