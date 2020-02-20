<?php namespace Flynsarmy\RelationTest\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Flynsarmy\RelationTest\Models\Post;
use Flynsarmy\RelationTest\Models\Term;

class Posts extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
    ];

    public $formConfig = 'config_form.yaml';

    public $bodyClass = 'compact-container';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Flynsarmy.RelationTest', 'relationtest', 'posts');
    }
}
