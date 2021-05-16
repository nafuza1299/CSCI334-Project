<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Storage;

class FileDownloadController extends Controller
{
    public function download_business_certs($file_name)
    {
        $user = Auth()->user();
        if($user->hasPermissionTo('CRUD businesses')){
            return Storage::download('business/certs/'.$file_name);
        }

    }

    public function download_user_certs($file_name)
    {
        $user = Auth()->user();
        if($user->hasPermissionTo('update users health status')){
            return Storage::download('user/certs/'.$file_name);
        }
        
    }
}
