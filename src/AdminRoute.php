<?php namespace JetCMS\Core;

use JetCMS\Core\Admin\Form\Markdown;
use FormItem;

class AdminRoute
{
    static Protected $route = [];

    static public function addModel($class){
        self::$route[] = $class;
    }

    static public function init(){

        FormItem::register('markdown', Markdown::class);

        foreach (self::$route as $val) {
            $menu = new $val();
            $menu->init();
        }
    }
}