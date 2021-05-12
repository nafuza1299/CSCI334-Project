<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\TestResultCreateRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;


class TestResultCRUDController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    
    public function setup()
    {
        CRUD::setModel(\App\Models\TestResult::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/testresult');
        CRUD::setEntityNameStrings('Test result', 'Test results');
    }

    protected function setupListOperation()
    {
        CRUD::addColumn(
            [
                    // Select
                'label'      => 'Username',
                'type'       => 'select',
                'name'       => 'id', // the db column for the foreign key
                'entity'     => 'user', // the method that defines the relationship in your Model
                'attribute'  => 'name', // foreign key attribute that is shown to user
                'model' => "App\Models\User",
            ]
        );
        CRUD::column('test_date');
        CRUD::column('location');
        CRUD::addcolumn([
            'name'  => 'infected',
            'label' => 'Positive',
            'type'  => 'boolean',
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(TestResultCreateRequest::class);
        CRUD::addfield(
        [  // Select
            'label'     => "User",
            'type'      => 'select',
            'name'      => 'user_id', // the db column for the foreign key 

            // optional - manually specify the related model and attribute
            'model'     => "App\Models\User", // related model
            'attribute' => 'name', // foreign key attribute that is shown to user
        ]);
        CRUD::addfield([   // Date
            'name'  => 'test_date',
            'label' => 'Test Date',
            'type'  => 'date'
        ]);
        CRUD::field('location');
        CRUD::addfield([
            'name'  => 'infected',
            'label' => 'Positive',
            'type'  => 'checkbox'
        ]);
    }
    
    protected function setupUpdateOperation()
    {
        CRUD::setValidation(TestResultCreateRequest::class);
        CRUD::addfield(
        [  // Select
            'label'     => "User",
            'type'      => 'select',
            'name'      => 'user_id', // the db column for the foreign key 

            // optional - manually specify the related model and attribute
            'model'     => "App\Models\User", // related model
            'attribute' => 'name', // foreign key attribute that is shown to user
        ]);
        CRUD::addfield([   // Date
            'name'  => 'test_date',
            'label' => 'Test Date',
            'type'  => 'date'
        ]);
        CRUD::field('location');
        CRUD::addfield([   // Date
            'name'  => 'infected',
            'label' => 'Positive',
            'type'  => 'checkbox'
        ]);
    }
}
