<?php namespace Flynsarmy\RelationTest;

use Backend;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'Relation Test',
            'description' => 'Demonstrates condition restrictions not working correctly on relations',
            'author'      => 'Flyn San',
            'icon'        => 'icon-pencil'
        ];
    }
}
