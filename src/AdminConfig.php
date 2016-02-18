<?php namespace JetCMS\Core;

use App\Page;
use App\Menu;

use Request;
use Sentinel;
use Carbon;

use Admin;
use AdminDisplay;
use ColumnFilter;
use Column;
use AdminForm;
use FormItem;


class AdminConfig
{
    Protected $accessMenu = 'admin.pages.*';

    Protected $model = null;
    Protected $modelTitle = null;
    Protected $modelAlias = null;


    Public function init() {
        $this->initMenu();
        $this->initForm();
    }

    Protected function initMenu(){
        if (Sentinel::check()) {
            if (Sentinel::hasAnyAccess($this->accessMenu, 'superadmin')) {
                return $this->addMenu();
            }
        }
    }

    Protected function initForm(){
        Admin::model($this->model)->title($this->modelTitle)->alias($this->modelAlias)->display(function (){

            return $this->addColumn();

        })->create(function ($id){

            return $this->addCreate($id);

        })->edit(function ($id){

            return $this->addEdit($id);

        });
    }

    Protected function addMenu(){

    }

    static Protected function addColumn(){

    }

    Protected function addCreate($id){

    }

    Protected function addEdit($id){

    }
}