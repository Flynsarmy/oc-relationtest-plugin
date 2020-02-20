# Relation Test

Demonstrates condition restrictions not working correctly on relations

## Issues

If you have two belongsToMany relations on the same table with a `conditions` 
value set, record retrieval (`$record->myRelation`) works correctly and applies 
the specified conditions, however saving `$record` wiil result in the first 
relation being wiped and only the second relation will save.

## Steps to Replicate

* `git clone` to */plugins/flynsarmy/relationtest*
* `php artisan plugin:refresh Flynsarmy.RelationTest`
* Go to */backend/flynsarmy/relationtest/posts/update/1*
* Notice we have two categories in our *category* relation and two tags in our *tags* relation. Both relations connect to the same table but use a `conditions` option in our model.
* Hit Save
* Refresh
* *Categories* has been wiped but *Tags* saved.

## Issue in Depth

In our `Post` model we have two relations defined:
```php
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
```
These link to the same table but retrieval and display on our form works as 
expected thanks to our `conditions` statement. This can be further be confirmed 
with
```bash
php artisan tinker
Flynsarmy\RelationTest\Models\Post::first()->tags
Flynsarmy\RelationTest\Models\Post::first()->categories
```

When saving the model, `October\Rain\Database\Relations\BelongsToMany::setSimpleValue()` 
calls `$this->sync($value);`.
The `sync` method defined in */vendor/laravel/framework/src/Illuminate/Database/Eloquent/Relations/Concerns/InteractsWithPivotTable.php*
has the lines
```php
    $current = $this->newPivotQuery()->pluck(
        $this->relatedPivotKey
    )->all();
```
to determine which records need to be saved for the current relation. The problem is
`newPivotQuery()` doesn't apply our `conditions`, so the query 
```sql
select * from `flynsarmy_relationtest_posts_terms` where `post_id` = ?
```
is executed and ALL records in this table are returned instead of just the ones
relevent to the current relation.
The next lines in this class:
```php
$detach = array_diff($current, array_keys(
    $records = $this->formatRecordsList($this->parseIds($ids))
));
```
detect which records weren't selected on our form and lists them for removal.

Because our form has the *Categories* field first, it marks the tag records for removal.
Removal occurs, and we move on to the *Tags* field. The same thing happens and our
categories are marked for removal.

The end result is only the tags are saved and all categories are removed.