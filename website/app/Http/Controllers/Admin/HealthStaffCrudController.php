<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\HealthStaffRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class HealthStaffCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class HealthStaffCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    // use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\HealthStaff::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/healthstaff');
        CRUD::setEntityNameStrings('Health Staff', 'Health Staffs');
        
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // CRUD::column('user_id');
        // CRUD::column('name');
        // CRUD::column('first_name');
        // CRUD::column('last_name');
        
        
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
        CRUD::column('health_org_email');

        CRUD::addColumn([
            // Select
           'label'      => 'First Name',
           'type'       => 'select',
           'name'       => 'id', // the db column for the foreign key
           'key'       => 'first_name',
           'entity'     => 'user', // the method that defines the relationship in your Model
           'attribute'  => 'first_name', // foreign key attribute that is shown to user
           'model' => "App\Models\User"
        ]);

        CRUD::addColumn([
            // Select
           'label'      => 'Last Name',
           'type'       => 'select',
           'name'       => 'id', // the db column for the foreign key
           'key'       => 'last_name',
           'entity'     => 'user', // the method that defines the relationship in your Model
           'attribute'  => 'last_name', // foreign key attribute that is shown to user
           'model' => "App\Models\User"
        ]);


        CRUD::column('position');
        CRUD::column('business');
        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(HealthStaffRequest::class);

        CRUD::field('position');
        CRUD::field('business');
        CRUD::field('health_org_email');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        CRUD::setValidation(HealthStaffRequest::class);
        CRUD::field('position');
        CRUD::field('business');
        CRUD::field('health_org_email');
    }
}
