<?php

namespace App\Http\Controllers\FileDownloadControllers;

use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Storage;

class UserFileDownloadController extends FileDownloadController
{
    public function download_certs($file_name)
    {
        $user = auth()->user();
        if($user->hasPermissionTo('update users health status')){
            return Storage::download('user/certs/'.$file_name);
        }
        
    }
}
