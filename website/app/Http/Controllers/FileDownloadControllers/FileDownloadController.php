<?php

namespace App\Http\Controllers\FileDownloadControllers;


use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Storage;

abstract class FileDownloadController extends Controller
{
    abstract function download_certs($file_name);
}
