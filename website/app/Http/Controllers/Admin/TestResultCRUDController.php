<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\TestResultCreateRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Auth;
use App\Models\HealthStaff;
use App\Models\Business;
use App\Models\BusinessAddress;

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
        $user = Auth::user();
        if(!$user->hasRole('admin')){
            $healthstaff = HealthStaff::where('user_id', $user->id)->first();
            $org = Business::where('id', $healthstaff->business_id)->first();
            
            $addresses = BusinessAddress::where('business_id', $org->id)->get()->toArray();
            $getAddressID = array_filter(array_map(function($data) { return $data['id']; }, $addresses));
            $this->crud->addClause('whereIn', 'business_address_id', $getAddressID);
            
        }
                    
        
        CRUD::addColumn(
            [
                    // Select
                'label'      => 'Username',
                'type'       => 'select',
                'name'       => 'id', // the db column for the foreign key
                'key'       => 'name',
                'entity'     => 'user', // the method that defines the relationship in your Model
                'attribute'  => 'name', // foreign key attribute that is shown to user
                'model' => "App\Models\User",
            ]
        );
        CRUD::column('test_date');
        CRUD::addColumn([
            // Select
           'label'      => 'Location',
           'type'       => 'select',
           'name'       => 'business_address_id', // the db column for the foreign key
           'key'       => 'address',
           'entity'     => 'businessaddress', // the method that defines the relationship in your Model
           'attribute'  => 'address', // foreign key attribute that is shown to user
           'model' => "App\Models\BusinessAddress"
        ]);
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
            'type'      => 'select2',
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
        CRUD::addfield(
            [  // Select
                'label'     => "Location",
                'type'      => 'select2',
                'name'      => 'business_address_id', // the db column for the foreign key 
                // optional - manually specify the related model and attribute
                'model'     => "App\Models\BusinessAddress", // related model
                'attribute' => 'address', // foreign key attribute that is shown to user

                'options'   => (function ($query) {
                    $user = Auth::user();
                    if($user->hasRole('admin')){
                        return $query->get();
                    }
                    else{
                        $healthstaff = HealthStaff::where('user_id', $user->id)->first();
                        return $query->where('business_id', $healthstaff->business_id)->get();
                    }
                    
                }), //  you can use this to filter the results show in the select
            ]);
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
            'type'      => 'select2',
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
        CRUD::addfield(
            [  // Select
                'label'     => "Location",
                'type'      => 'select2',
                'name'      => 'business_address_id', // the db column for the foreign key 
                // optional - manually specify the related model and attribute
                'model'     => "App\Models\BusinessAddress", // related model
                'attribute' => 'address', // foreign key attribute that is shown to user

                'options'   => (function ($query) {
                    $user = Auth::user();
                    if($user->hasRole('admin')){
                        return $query->get();
                    }
                    else{
                        $healthstaff = HealthStaff::where('user_id', $user->id)->first();
                        return $query->where('business_id', $healthstaff->business_id)->get();
                    }
                    
                }), //  you can use this to filter the results show in the select
            ]);
        CRUD::addfield([   // Date
            'name'  => 'infected',
            'label' => 'Positive',
            'type'  => 'checkbox'
        ]);
    }
}
