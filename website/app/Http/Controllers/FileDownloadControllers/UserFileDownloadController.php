<?php

namespace App\Http\Controllers\FileDownloadControllers;

use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Storage;

class UserFileDownloadController extends FileDownloadController
{
    public function download_certs($file_name)
    {
        return Storage::download('user/certs/'.$file_name);
    }
    public function self_download_certs()
    {
        $user = auth()->user()->certificate;
        return $this->download_certs($user);
        
    }
    public function admin_download_certs($file_name)
    {
        $user = auth()->user();
        if($user->hasPermissionTo('update users health status')){
            return $this->download_certs($file_name);
        }
    }
}
