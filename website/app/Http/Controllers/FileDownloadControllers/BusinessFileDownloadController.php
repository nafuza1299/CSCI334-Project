<?php

namespace App\Http\Controllers\FileDownloadControllers;

use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Storage;

class BusinessFileDownloadController extends FileDownloadController
{
    public function download_certs($file_name)
    {
        $user = auth()->user();
        if($user->hasPermissionTo('CRUD businesses')){
            return Storage::download('business/certs/'.$file_name);
        }

    }
}
