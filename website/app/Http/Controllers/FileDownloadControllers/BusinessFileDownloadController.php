<?php

namespace App\Http\Controllers\FileDownloadControllers;

use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Storage;

class BusinessFileDownloadController extends FileDownloadController
{
    public function download_certs($file_name)
    {
        return Storage::download('business/certs/'.$file_name);
    }
    public function self_download_certs()
    {
        $user = auth()->guard('business')->user()->certificate;
        return $this->download_certs($user);
        
    }
    public function admin_download_certs($file_name)
    {
        $user = auth()->user();
        if($user->hasPermissionTo('CRUD businesses')){
            return $this->download_certs($file_name);
        }
    }
}
