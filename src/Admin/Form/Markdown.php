<?php namespace JetCMS\Core\Admin\Form;

use SleepingOwl\Admin\FormItems\NamedFormItem;
use AssetManager;

class Markdown extends NamedFormItem
{

    public function initialize()
    {
        parent::initialize();
/*
        AssetManager::addStyle(asset('bower_components/bootstrap-markdown-editor/dist/css/bootstrap-markdown-editor.css'));
        AssetManager::addScript(asset('bower_components/ace-builds/src-min/ace.js'));
        AssetManager::addScript(asset('bower_components/bootstrap-markdown-editor/dist/js/bootstrap-markdown-editor.js'));
*/
        AssetManager::addStyle(asset('vendor/jetcms/core/css/bootstrap-markdown-editor.css'));
        AssetManager::addScript(asset('vendor/jetcms/core/js/ace.js'));
        AssetManager::addScript(asset('vendor/jetcms/core/js/bootstrap-markdown-editor.js'));


    }

    public function render()
    {
        $params = $this->getParams();
        // $params will contain 'name', 'label', 'value' and 'instance'
        return view('jetcms.core::admin.form.markdown', $params);
    }

}