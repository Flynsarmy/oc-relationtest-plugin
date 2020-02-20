<?php namespace Flynsarmy\RelationTest\Models;

use Model;

class Post extends Model
{
    public $table = 'flynsarmy_relationtest_posts';

    public $belongsToMany = [
        'tags' => [
            'Flynsarmy\RelationTest\Models\Term',
            'table' => 'flynsarmy_relationtest_posts_terms',
            'key'        => 'post_id',
            'otherKey'   => 'term_id',
            'conditions' => 'type = "tag"'
        ],
        'categories' => [
            'Flynsarmy\RelationTest\Models\Term',
            'table' => 'flynsarmy_relationtest_posts_terms',
            'key'        => 'post_id',
            'otherKey'   => 'term_id',
            'conditions' => 'type = "category"'
        ],
    ];
}
