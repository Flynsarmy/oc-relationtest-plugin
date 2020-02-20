<?php namespace Flynsarmy\RelationTest\Updates;

use DB;
use Flynsarmy\RelationTest\Models\Term;
use Flynsarmy\RelationTest\Models\Post;
use October\Rain\Database\Updates\Seeder;

class SeedAllTables extends Seeder
{
    public function run()
    {
        // Create a Post
        $post = Post::create([
            'type' => 'post',
            'title' => 'A Post',
        ]);

        $product = Post::create([
            'type' => 'product',
            'title' => 'A Product',
        ]);

        $category = Term::create([
            'type' => 'category',
            'name' => 'A Category',
        ]);
        $category2 = Term::create([
            'type' => 'category',
            'name' => 'Second Category',
        ]);

        $tag = Term::create([
            'type' => 'tag',
            'name' => 'A Tag',
        ]);
        $tag2 = Term::create([
            'type' => 'tag',
            'name' => 'Second Tag',
        ]);

        $post->tags()->add($tag);
        $post->tags()->add($tag2);
        $post->categories()->add($category);
        $post->categories()->add($category2);
    }
}
