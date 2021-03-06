<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class UserVaccineController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    

    public function setup()
    {
        CRUD::setModel(\App\Models\User::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/vaccine');
        CRUD::setEntityNameStrings('User', 'Users');
    }

    public function setupListOperation()
    {
        CRUD::addColumns([
            [
                'name'  => 'name',
                'label' => trans('backpack::permissionmanager.name'),
                'type'  => 'text',
            ],
            [
                'name'  => 'email',
                'label' => trans('backpack::permissionmanager.email'),
                'type'  => 'email',
            ],
            [
                'name'  => 'first_name',
                'label' => "First Name",
                'type'  => 'text',
            ],
            [
                'name'  => 'last_name',
                'label' => "Last Name",
                'type'  => 'text',
            ],
            [
                'name'  => 'vaccinated',
                'label' => "Vaccinated",
                'type'  => 'boolean',
            ],
        ]);

        CRUD::addcolumn(
            [
                'name'      => 'certificate', // The db column name
                'label'     => 'Certificate', // Table column heading
                'wrapper'   => [
                    'element' => 'a', // the element will default to "a" so you can skip it here 
                    'href' => function ($crud, $column, $entry, $related_key) {
                        return backpack_url('user/certs/'.$entry["certificate"]);
                    },
                    'target' => '_blank',
                    // 'class' => 'some-class',
            ],
        ]);
        
    }

    

    public function setupUpdateOperation()
    {
        CRUD::field('vaccinated');
    }

    
}
