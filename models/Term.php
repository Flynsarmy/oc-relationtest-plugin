<?php namespace Flynsarmy\RelationTest\Models;

use Model;

class Term extends Model
{
    public $table = 'flynsarmy_relationtest_terms';

    public $belongsToMany = [
        'posts' => [
            'Flynsarmy\RelationTest\Models\Post',
            'table'      => 'flynsarmy_relationtest_posts_terms',
            'key'        => 'term_id',
            'otherKey'   => 'post_id',
            'conditions' => 'type = "post"'
        ],
        'products' => [
            'Flynsarmy\RelationTest\Models\Post',
            'table'      => 'flynsarmy_relationtest_posts_terms',
            'key'        => 'term_id',
            'otherKey'   => 'post_id',
            'conditions' => 'type = "product"'
        ],
    ];
}
